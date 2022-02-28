<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Responses\User\IndexResponse;
use App\Http\Responses\User\ShowResponse;
use App\Http\Responses\User\StoreResponse;
use App\Mail\UserCreated;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    protected $routePrefix = 'web';
    protected $repository, $role;

    public function __construct(User $user, Role $role)
    {
        $this->middleware('auth');
        $this->middleware(['permission:user-view|user-create|user-edit|user-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
        $this->repository = new UserRepository($user);
        $this->role = new RoleRepository($role);
    }


    /**
     * Display a listing of the resource.
     * @return IndexResponse
     */
    public function index(): IndexResponse
    {
        $users = $this->repository->getAll()->sortByDesc('created_at');
        return new IndexResponse($users, $this->routePrefix);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateUserRequest $request
     * @return StoreResponse
     */
    public function store(CreateUserRequest $request): StoreResponse
    {
        $password_generated = Str::random(10);
        $request->request->add(['password_generated' => $password_generated]);
        $input = $request->all();
        $user = $this->repository->create($input);
        $user->assignRole($this->role->getById($input['role_id'])->name, $this->routePrefix);
        return new StoreResponse($user, $password_generated);
    }

    /**
     * Show the specified resource.
     * @param $id
     * @return ShowResponse
     */
    public function show($id): ShowResponse
    {
        $user = $this->repository->getById($id);
        return new ShowResponse($user);
    }

    /**
     * @param CreateUserRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CreateUserRequest $request, $id): RedirectResponse

    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $user = $this->repository->getById($id);
            if (!isset($input['super']))
                $input['super'] = false;
            $user->update($input);
            $roles = $user->roles->where('guard_name', $this->routePrefix);
            foreach ($roles as $role) {
                $user->removeRole($role);
            }
            $user->assignRole($this->role->getById($input['role_id'])->name, $this->routePrefix);
            DB::commit();
            return redirect()->route('users.show', $user->id)
                ->with('success', 'User created successfully');
        } catch (\Exception $exception) {
            DB::commit();
            return redirect()
                ->back()
                ->with('failed', 'Failed to create')
                ->withInput();

        }


    }

    public function edit(User $user)
    {
        $roles = $this->role->allRolesByGuard($this->routePrefix);
        $roles = $roles->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = $this->role->allRolesByGuard($this->routePrefix);
        $roles = $roles->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = $this->repository->getById($id);
            $roles = $user->roles;
            $applicationPermission = User::applicationPermissions();
            $applicationPermission = array_diff($applicationPermission, [$this->routePrefix . '-permission']);
            if (!empty($applicationPermission)) {
                if ($user->hasAnyPermission($applicationPermission)) {
                    $this->repository->deleteFomApplication($id, $roles, $this->routePrefix);
                } else {
                    $this->repository->delete($id);
                }
            } else {
                $this->repository->delete($id);
            }
            DB::commit();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } catch (\PDOException $ex) {
            DB::rollBack();
            try {
                if (!empty($user)) {
                    $user->status = false;
                    $user->save();
                }
                DB::commit();
                return redirect()->route('users.index')
                    ->with('warning', 'The user cannot be deleted. Thus, the user has been inactivated.');
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->route('users.index')
                    ->with('failed', 'User cannot be deleted.');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('users.index')
                ->with('failed', 'User cannot be deleted.');
        }
    }


    public function profile()
    {
//        $user = $this->repository->getById(Auth::user()->id);
//        $locationRepo = new LocationRepository((new Location()));
//        $selectDepartments = $this->department->selectDepartments();
//        $selectLocations = $locationRepo->selectLocations();
//        return view('auth::users.profile', compact('user', 'selectDepartments', 'selectLocations'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $input = $request->all();
        $user = $this->repository->getById($id);
        $user->update($input);
        return redirect()->route($this->routePrefix . '.profile')
            ->with('success', 'Profile updated successfully');
    }

    public function updateAvatar(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $img = Image::make($avatar->getRealPath());
            $img->stream();
            Storage::disk('local')->put('/public/avatars/' . $filename, $img, 'public');
            $user = Auth::user();
            Storage::delete('/public/avatars/' . $user->avatar);
            $user->avatar = $filename;
            $user->save();
            return redirect()->route($this->routePrefix . '.profile')
                ->with('success', 'Profile image updated successfully');
        }
    }
}
