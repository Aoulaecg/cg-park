<?php

namespace App\Http\Controllers;

use App\Models\Parking;
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

        $parkings = Parking::active()->byCity($slug)->orderBy('sort_order')->get();

        return view('villes.show', [
            'city'     => $city,
            'parkings' => $parkings,
        ]);
    }

    public function parking(string $slug): View
    {
        $parking = Parking::active()->where('slug', $slug)->firstOrFail();

        $city = collect(config('cgpark.cities'))->get($parking->city_slug);

        abort_unless($city, 404);

        $relatedParkings = Parking::active()
            ->byCity($parking->city_slug)
            ->where('slug', '!=', $slug)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('parkings.show', [
            'parking'         => $parking,
            'city'            => $city,
            'relatedParkings' => $relatedParkings,
        ]);
    }

    protected function citiesWithParkingCounts(): Collection
    {
        $counts = Parking::active()
            ->selectRaw('city_slug, count(*) as parking_count')
            ->groupBy('city_slug')
            ->pluck('parking_count', 'city_slug');

        return collect(config('cgpark.cities'))
            ->map(function (array $city) use ($counts) {
                $city['parking_count'] = $counts->get($city['slug'], 0);
                return $city;
            })
            ->values();
    }
}
