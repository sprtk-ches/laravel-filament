<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['is_active', 'is_something_else'])
            ->using(UserRole::class);
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }
}
