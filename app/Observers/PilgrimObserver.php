<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\Pilgrim;

class PilgrimObserver
{
    public function saving(Pilgrim $pilgrim)
    {
        if (request()->has(['oblast_id', 'city_id', 'district_id', 'mahalla_id', 'home'])) {
            if ($pilgrim->address) {
                $pilgrim->address->update([
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

                $pilgrim->address_id = $address->id;
            }
        }
    }
}
