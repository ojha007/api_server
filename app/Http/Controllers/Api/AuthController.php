<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $data = $this->transformUser($user);
            return new SuccessResponse($data);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:Worker,Customer'
        ], [
            'confirm_password' => "Password Confirmation doesn't match",
            "role.in" => "Role can be either Worker or Customer"
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->assignRole($request->get('role'));
        $data = $this->transformUser($user);
        return new SuccessResponse($data);
    }

    protected function transformUser($user): array
    {
        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'super' => $user->super ?? 0,
                'status' => $user->status ?? 0,
                'avatar' => $user->avatar ?? 'default.jpg',
                'phone' => $user->phone,
                'email_verified_at' => $user->email_verified_at,
            ],
            'role' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions() ? $user->getAllPermissions()->pluck('name') : [],
            'token' => $user->createToken('MyApp')->accessToken
        ];
    }
}
