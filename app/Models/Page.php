<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = ['user_id', 'hash', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function scopeActive(Builder $builder): void
    {
        $builder->where('expires_at', '>=', now());
    }

    public function scopeHash(Builder $builder, string $hash): void
    {
        $builder->where('hash', $hash);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
