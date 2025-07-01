<?php

namespace App\Http\Services;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{
    public function listUsers($request)
    {
        $users = User::all();
        $usersResponse = UserResource::collection($users);

        return $usersResponse;
    }
}
