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
        }
        catch (\Exception $e)
        {
            return $this->error(
                false,
                'Failed to retrieve user list',
                [],
                500
            );
        }
    }
}
