<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\ValidationResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            return new ValidationResponse($validator);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $data = $this->transformUser($user);
            return new SuccessResponse($data);
        } else {

            return new ValidationResponse(null, 'Email and password does not matches.');
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
            return new ValidationResponse($validator);
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
                'avatar' => asset($user->avatar) ?? 'default.jpg',
                'phone' => $user->phone,
                'email_verified_at' => $user->email_verified_at,
            ],
            'role' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions() ? $user->getAllPermissions()->pluck('name') : [],
            'token' => $user->createToken('MyApp')->accessToken
        ];
    }


    public function getLoggedInUser(): SuccessResponse
    {
        $user = Auth::user();
        $data = $this->transformUser($user);
        return new SuccessResponse($data);
    }


    public function changePassword(ChangePasswordRequest $request): SuccessResponse
    {

        $user = Auth::user();
        $password = Hash::make($request->get('new_password'));
        $user->update(['password' => $password]);
        return new SuccessResponse();

    }


    public function changeProfile(ChangeProfileRequest $request)
    {
        try {
            $user = Auth::user();
            $attributes = $request->validated();
            if ($request->has('avatar')) {
                $file_data = $request->input('avatar');
                $file_name = 'users/images/' . Str::uuid() . time() . '.png';
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    Storage::disk('public')
                        ->put($file_name, base64_decode($file_data));
                    $attributes['avatar'] = Storage::url($file_name);
                }
            }
            User::find($user->id)
                ->update($attributes);
            return new SuccessResponse();
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

}
