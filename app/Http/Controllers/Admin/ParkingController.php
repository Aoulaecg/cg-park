<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParkingRequest;
use App\Models\Parking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParkingController extends Controller
{
    public function index(): View
    {
        $search   = request('search');
        $city     = request('city');
        $status   = request('status');

        $parkings = Parking::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%"))
            ->when($city,   fn ($q) => $q->where('city_slug', $city))
            ->when($status !== null && $status !== '', fn ($q) => $q->where('is_active', (bool) $status))
            ->orderBy('city_slug')
            ->orderBy('sort_order')
            ->paginate(15)
            ->withQueryString();

        $cities = collect(config('cgpark.cities'))->values();

        return view('admin.parkings.index', compact('parkings', 'cities'));
    }

    public function create(): View
    {
        $cities = collect(config('cgpark.cities'))->values();

        return view('admin.parkings.form', compact('cities'));
    }

    public function store(StoreParkingRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('parkings', 'public');
        }

        Parking::create($data);

        return redirect()->route('console.parkings.index')
            ->with('success', 'Parking créé avec succès.');
    }

    public function edit(Parking $parking): View
    {
        $cities = collect(config('cgpark.cities'))->values();

        return view('admin.parkings.form', compact('parking', 'cities'));
    }

    public function update(StoreParkingRequest $request, Parking $parking): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if stored in storage
            if ($parking->image && Str::startsWith($parking->image, 'parkings/')) {
                Storage::disk('public')->delete($parking->image);
            }
            $data['image'] = $request->file('image')->store('parkings', 'public');
        }

        $parking->update($data);

        return redirect()->route('console.parkings.index')
            ->with('success', 'Parking mis à jour avec succès.');
    }

    public function destroy(Parking $parking): RedirectResponse
    {
        if ($parking->image && Str::startsWith($parking->image, 'parkings/')) {
            Storage::disk('public')->delete($parking->image);
        }

        $parking->delete();

        return redirect()->route('console.parkings.index')
            ->with('success', 'Parking supprimé avec succès.');
    }
}
