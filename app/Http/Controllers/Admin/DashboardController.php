<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppelOffre;
use App\Models\Parking;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'parkings_total'   => Parking::count(),
            'parkings_actifs'  => Parking::active()->count(),
            'appels_total'     => AppelOffre::count(),
            'appels_ouverts'   => AppelOffre::ouvert()->count(),
            'total_places'     => Parking::active()->sum('capacity'),
            'villes_actives'   => Parking::active()->distinct('city_slug')->count('city_slug'),
        ];

        $recentParkings = Parking::latest()->take(6)->get();
        $recentAppels   = AppelOffre::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentParkings', 'recentAppels'));
    }
}
