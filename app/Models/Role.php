<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'level'];

    /**
     * Если роль связана с пользователями как "один ко многим".
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Если хочешь использовать "многие ко многим" — раскомментируй этот метод и создай таблицу role_user.
     */
    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class);
    // }
}
