<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pilgrim extends Authenticatable
{
    use HasFactory, Notifiable, softDeletes;

    protected $fillable = [
        'full_name',
        'phone_number',
        'passport_data',
        'pinfl',
        'photo_path',
        'piligrim_details_id',
        'email',
        'password'
    ];

    public function details()
    {
        return $this->belongsTo('App\Models\PilgrimDetail', 'pilgrim_details_id','id');
    }
}
