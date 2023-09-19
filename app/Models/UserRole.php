<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_roles';

    public $timestamps = false;

    protected $casts = [
        'is_active'         => 'boolean',
        'is_something_else' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'role_id',
        'is_active',
        'is_something_else',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
