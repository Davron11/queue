<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'oblast_id'];

    public function oblast()
    {
        return $this->belongsTo(Oblast::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
