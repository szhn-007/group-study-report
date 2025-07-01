<?php

namespace App\Http\Controllers\Admin;

use App\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(private UserService $userService)
    {
        $this->userService = $userService;
    }

    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try
        {
            $response = $this->userService->login($request, 'admin');

            if ($request->wantsJson())
            {
                return $this->success(
                    true,
                    'Admin logged in successfully.',
                    $response,
                    200
                );
            }

            return redirect()->route('admin.dashboard')->with([
                'success' => 'Admin logged in successfully.',
                'admin' => $response['user']
            ]);
        }
        catch (\Exception $e)
        {
            if ($request->wantsJson())
            {
                return $this->error(
                    false,
                    $e->getMessage(),
                    [],
                    $e->getCode() ?: 401
                );
            }

            return back()->withErrors([
                'login' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            $response = $this->userService->logout($request, 'admin');

            if ($request->wantsJson())
            {
                return $this->success(
                    true,
                    'Admin logged out successfully.',
                    $response,
                    200
                );
            }

            return redirect()->route('admin.login')->with([
                'success' => 'Admin logged out successfully.'
            ]);
        }
        catch (\Exception $e)
        {
            if ($request->wantsJson())
            {
                return $this->error(
                    false,
                    $e->getMessage(),
                    [],
                    $e->getCode() ?: 401
                );
            }

            return back()->withErrors([
                'logout' => $e->getMessage()
            ]);
        }
    }

    // public function forgotPasswordPage()
    // {
    //     return view('admin.auth.forgot-password');
    // }

    // public function forgotPassword(Request $request)
    // {
    //     try
    //     {
    //         $this->userService->forgotPassword($request, 'admin');

    //         if ($request->wantsJson())
    //         {
    //             return $this->success(
    //                 true,
    //                 'Password reset link sent successfully.',
    //                 [],
    //                 200
    //             );
    //         }

    //         return back()->with([
    //             'success' => 'We have emailed your password reset link.'
    //         ]);
    //     }
    //     catch (\Exception $e)
    //     {
    //         if ($request->wantsJson())
    //         {
    //             return $this->error(
    //                 false,
    //                 $e->getMessage(),
    //                 [],
    //                 $e->getCode() ?: 400
    //             );
    //         }

    //         return back()->withErrors([
    //             'forgotPassword' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function resetPasswordPage(Request $request, string $token)
    // {
    //     return view('admin.auth.reset-password', ['token' => $token, 'email' => $request->email]);
    // }

    // public function resetPassword(Request $request)
    // {
    //     try
    //     {
    //         $this->userService->resetPassword($request, 'admin');

    //         if ($request->wantsJson())
    //         {
    //             return $this->success(
    //                 true,
    //                 'Password reset successfully.',
    //                 [],
    //                 200
    //             );
    //         }

    //         return redirect()->route('admin.login')->with([
    //             'success' => 'Your password has been reset successfully. You can now log in.'
    //         ]);
    //     }
    //     catch (\Exception $e)
    //     {
    //         if ($request->wantsJson())
    //         {
    //             return $this->error(
    //                 false,
    //                 $e->getMessage(),
    //                 [],
    //                 $e->getCode() ?: 400
    //             );
    //         }

    //         return back()->withErrors([
    //             'resetPassword' => $e->getMessage()
    //         ]);
    //     }
    // }

    public function list(Request $request)
    {
        try
        {
            $users = $this->userService->listUsers($request);

            if ($request->wantsJson())
            {
                return $this->success(
                    true,
                    'Uses retrieved successfully',
                    $users,
                    200
                );
            }

            return view('admin.users.list', [
                'users' => $users,
            ]);
        }
        catch (\Exception $e)
        {
            if ($request->wantsJson())
            {
                return $this->error(
                    false,
                    $e->getMessage(),
                    [],
                    500
                );
            }

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
