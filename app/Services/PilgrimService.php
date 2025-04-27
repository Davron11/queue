<?php

namespace App\Services;

use App\Models\Pilgrim;
use Illuminate\Http\Request;

class PilgrimService
{
    /**
     * @param User $user
     * @param Request $request
     */
    public function fillingPilgrim(Pilgrim $pilgrim, Request $request)
    {
        $pilgrim->fill([
            'full_name' => $request['full_name'],
            'pinfl' => $request['pinfl'],
            'phone_number' => $request['phone_number'],
            'passport_data' => $request['passport_series'] ?? null,
            'password' => $request['password'] ? bcrypt($request['password']) : $pilgrim->password,
        ]);

        $pilgrim->save();
    }
}
