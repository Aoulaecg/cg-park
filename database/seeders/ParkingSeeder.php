<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    public function run(): void
    {
        $parkings = config('cgpark.parkings');

        foreach ($parkings as $index => $data) {
            Parking::create([
                'name'           => $data['name'],
                'slug'           => $data['slug'] . '-' . ($index + 1),
                'city_slug'      => $data['city_slug'],
                'image'          => $data['image'] ?? null,
                'capacity'       => $data['capacity'] ?? 0,
                'type'           => $data['type'] ?? 'surface',
                'levels'         => $data['levels'] ?? null,
                'location'       => $data['location'] ?? null,
                'short_location' => $data['short_location'] ?? null,
                'address'        => $data['address'] ?? $data['location'] ?? null,
                'description'    => $data['description'] ?? null,
                'lat'            => $data['lat'] ?? null,
                'lng'            => $data['lng'] ?? null,
                'is_active'      => true,
                'sort_order'     => $index,
            ]);
        }
    }
}
