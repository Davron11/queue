<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if (request()->has(['oblast_id', 'city_id', 'district_id', 'mahalla_id', 'home'])) {
            if ($user->address) {
                $user->address->update([
                    'oblast_id' => request('oblast_id'),
                    'city_id' => request('city_id'),
                    'district_id' => request('district_id'),
                    'mahalla_id' => request('mahalla_id'),
                    'home' => request('home'),
                ]);
            } else {
                $address = Address::create([
                    'oblast_id' => request('oblast_id'),
                    'city_id' => request('city_id'),
                    'district_id' => request('district_id'),
                    'mahalla_id' => request('mahalla_id'),
                    'home' => request('home'),
                ]);

                $user->address_id = $address->id;
            }
        }
    }
}
