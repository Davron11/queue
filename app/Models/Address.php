<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['oblast_id', 'city_id', 'district_id', 'mahalla_id', 'home'];

    public function oblast()
    {
        return $this->belongsTo('App\Models\Oblast', 'oblast_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function mahalla()
    {
        return $this->belongsTo('App\Models\Mahalla', 'mahalla_id');
    }
}
