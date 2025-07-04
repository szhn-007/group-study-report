<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function login($request, $role = 'creator')
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request['email'])->first();
        if (!$user)
        {
            throw new \Exception('User not found.', 404);
        }
        $userResponse = new UserResource($user);

        $remember = $request->filled('remember');

        $loggedIn = Auth::guard('web')->attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ], $remember);
        if (!$loggedIn)
        {
            throw new \Exception('Invalid credentials.', 401);
        }

        if ($role === 'creator')
        {
            if ($user->role !== 'creator' || $user->role !== 'admin')
            {
                throw new \Exception('Invalid role.', 403);
            }

            $response['token'] = $user->createToken('authToken')->plainTextToken;
        }
        else
        {
            $request->session()->regenerate();
        }

        $response['user'] = $userResponse;

        return $response;
    }

    public function logout($request, $role = 'creator')
    {
        if ($role === 'creator')
        {
            $loggedOut = $request->user()->currentAccessToken()->delete();
            if (!$loggedOut)
            {
                throw new \Exception('Failed to log out.', 500);
            }
        }
        else
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return true;
    }

    // public function forgotPassword($request, $role = 'user')
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     if ($role === 'user')
    //     {
    //         $user = User::where('email', $request['email'])->first();
    //         if (!$user)
    //         {
    //             throw new \Exception('User not found.', 404);
    //         }

    //         $otp = rand(1000, 9999);

    //         $user->otp = $otp;
    //         $user->otp_expires_at = Carbon::now()->addMinutes(10);
    //         $user->save();

    //         Mail::to($user->email)->send(new PasswordResetOtpMail($otp));
    //     }
    //     else
    //     {
    //         $admin = Admin::where('email', $request['email'])->first();
    //         if (!$admin)
    //         {
    //             throw new \Exception('Admin not found.', 404);
    //         }

    //         $status = Password::broker('admins')->sendResetLink(
    //             $request->only('email')
    //         );

    //         return $status === Password::RESET_LINK_SENT
    //             ? back()->with(['status' => __($status)])
    //             : back()->withErrors(['email' => __($status)]);
    //     }

    //     return true;
    // }


    // public function resetPassword($request, $role = 'user')
    // {
    //     if ($role === 'user')
    //     {
    //         $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required|string|min:8|confirmed',
    //         ]);

    //         $user = User::where('email', $request['email'])->first();
    //         if (!$user)
    //         {
    //             throw new \Exception('User not found.', 404);
    //         }

    //         $user->password = bcrypt($request['password']);
    //         $user->save();
    //     }
    //     else
    //     {
    //         $request->validate([
    //             'token' => 'required',
    //             'email' => 'required|email',
    //             'password' => 'required|confirmed|min:8',
    //         ]);

    //         $status = Password::broker('admins')->reset(
    //             $request->only('email', 'password', 'password_confirmation', 'token'),
    //             function ($admin, $password)
    //             {
    //                 $admin->forceFill([
    //                     'password' => Hash::make($password),
    //                     'remember_token' => Str::random(60),
    //                 ])->save();

    //                 event(new PasswordReset($admin));
    //             }
    //         );

    //         return $status == Password::PASSWORD_RESET
    //             ? redirect()->route('admin.login')->with('status', __($status))
    //             : back()->withInput($request->only('email'))
    //                 ->withErrors(['email' => __($status)]);
    //     }

    //     return true;
    // }

    public function listUsers($request)
    {
        $users = User::all();
        $usersResponse = UserResource::collection($users);

        return $usersResponse;
    }
}
