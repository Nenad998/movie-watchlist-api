<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'external_id',
        'external_source',
        'title',
        'year',
        'poster',
        'plot',
        'genre',
        'director',
        'runtime',
        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
    ];

    public function watchlistItems(): HasMany
    {
        return $this->hasMany(WatchlistItem::class);
    }
}
