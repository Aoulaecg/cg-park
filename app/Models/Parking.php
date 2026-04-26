<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Parking extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city_slug',
        'image',
        'capacity',
        'type',
        'levels',
        'location',
        'short_location',
        'address',
        'description',
        'schedule',
        'rates',
        'lat',
        'lng',
        'maps_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'capacity'  => 'integer',
        'lat'       => 'float',
        'lng'       => 'float',
        'is_active' => 'boolean',
        'sort_order'=> 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByCity(Builder $query, string $citySlug): Builder
    {
        return $query->where('city_slug', $citySlug);
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        // Compatibility with views that use array access
        $array['hero_image'] = $array['image'] ?? null;
        return $array;
    }
}
