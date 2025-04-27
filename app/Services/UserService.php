<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{

    /**
     * @param User $user
     * @param Request $request
     */
    public function fillingUser(User $user, Request $request)
    {logger($request->all());
        $user->fill([
            'full_name' => $request['full_name'],
            'pinfl' => $request['pinfl'],
            'phone_number' => $request['phone_number'],
            'role_id' => $request['role_id'],
            'passport_data' => $request['passport_series'] ?? null,
            'password' => $request['password'] ? bcrypt($request['password']) : $user->password,
        ]);

        $user->save();
    }
}
