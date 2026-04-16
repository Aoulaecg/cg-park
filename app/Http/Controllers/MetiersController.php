<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class MetiersController extends Controller
{
    public function index(): View
    {
        $cities = $this->citiesWithParkingCounts();

        return view('nos-metiers', [
            'cities' => $cities,
        ]);
    }

    public function city(string $slug): View
    {
        $city = collect(config('cgpark.cities'))->get($slug);

        abort_unless($city, 404);

        $parkings = $this->parkings()->where('city_slug', $slug)->values();

        return view('villes.show', [
            'city' => $city,
            'parkings' => $parkings,
        ]);
    }

    public function parking(string $slug): View
    {
        $parking = $this->parkings()->firstWhere('slug', $slug);

        abort_unless($parking, 404);

        $city = collect(config('cgpark.cities'))->get($parking['city_slug']);
        $relatedParkings = $this->parkings()
            ->where('city_slug', $parking['city_slug'])
            ->reject(fn (array $item) => $item['slug'] === $slug)
            ->take(3)
            ->values();

        return view('parkings.show', [
            'parking' => $parking,
            'city' => $city,
            'relatedParkings' => $relatedParkings,
        ]);
    }

    protected function citiesWithParkingCounts(): Collection
    {
        $parkings = $this->parkings();

        return collect(config('cgpark.cities'))
            ->map(function (array $city) use ($parkings) {
                $city['parking_count'] = $parkings->where('city_slug', $city['slug'])->count();

                return $city;
            })
            ->values();
    }

    protected function parkings(): Collection
    {
        return collect(config('cgpark.parkings'));
    }
}
