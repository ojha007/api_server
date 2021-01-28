<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Responses\Role\EditResponse;
use App\Http\Responses\Role\IndexResponse;
use App\Http\Responses\Role\StoreResponse;
use App\Http\Responses\Role\UpdateResponse;
use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $model;
    protected $routePrefix = 'web';

    public function __construct(Role $role)
    {
        $this->middleware('auth');
        $this->middleware(['permission:role-view|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->model = new RoleRepository($role);
    }

    /**
     * Display a listing of the resource.
     * @return IndexResponse
     */
    public function index()
    {
        $roles = $this->model->allRolesByGuard($this->routePrefix);
        return new IndexResponse($roles);
    }


    public function create()
    {
        return view('roles.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param CreateRoleRequest $request
     * @return StoreResponse
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
        $input['guard_name'] = 'web';
        $role = $this->model->create(Arr::except($input, ['permission', 'full-access']));
        if (isset($input['permission']))
            $role->syncPermissions($input['permission']);
        return new StoreResponse($role);
    }


    public function show()
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return EditResponse|void
     */
    public function edit($id)
    {

        $role = $this->model->getById($id);
        $view = view('roles.edit');
        return new EditResponse($role, $view);
    }


    /**
     * Update the specified resource in storage.
     * @param UpdateRoleRequest $request
     * @param $id
     * @return UpdateResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $input = $request->all();
        $role = $this->model->update($id, ['name' => $input['name']]);
        //$role = $this->model->update($id, array_except($input, ['permission', 'full-access']));
        if (isset($input['permission']))
            $role->syncPermissions($input['permission']);
        return new UpdateResponse($role);
    }


    public function destroy($id)
    {
        $role = $this->model->getById($id);
        $usersCount = User::role($role)->count();
        if ($usersCount > 0) {
            return redirect()->route('roles.index')
                ->with('failed', 'Role cannot be deleted. Users are found with this role.');
        } else {
            $this->model->delete($id);
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully.');
        }
    }
}
