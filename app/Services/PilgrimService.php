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

    public static function getAddress(Pilgrim$pilgrim)
    {
        return $pilgrim->address ? (
            $pilgrim->address->oblast->name .
            ', ' .
            $pilgrim->address->city->name .
            ', ' .
            $pilgrim->address->district->name .
            ', ' .
            $pilgrim->address->mahalla->name .
            ', ' .
            $pilgrim->address->home
        ) : '';
    }

    public static function getPosition(Pilgrim $pilgrim, string $type)
    {
        $pilgrims = Pilgrim::query()
            ->when(($type === 'hajj'), function ($query) {
                $query->whereIn('hajj_status', ['waiting', 'confirmed'])
                    ->orderByRaw('last_hajj_date IS NOT NULL')
                    ->orderBy('last_hajj_date', 'asc');
            })
            ->when(($type === 'umra'), function ($query) {
                $query->whereIn('umra_status', ['waiting', 'confirmed'])
                    ->orderByRaw('last_umra_date IS NOT NULL')
                    ->orderBy('last_umra_date', 'asc');
            })
            ->get();

        $position = $pilgrims->values()->search(function ($item) use ($pilgrim) {
            return $item->id === $pilgrim->id;
        });

        return $position ? $position + 1 : __('messages.out_of_list');
    }

    public static function getHajjWaitingTime(Pilgrim $pilgrim)
    {
        $position = self::getPosition($pilgrim, 'umra');
        $count_per_year = config()->get('app.hajj_people_count_per_year');logger([$count_per_year]);
        return is_int($position) ? $position/$count_per_year + 1 : '';
    }
}
