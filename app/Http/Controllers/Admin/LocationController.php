<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $search = request('search');

        $locations = Location::query()
            ->when($search, function ($query, $search) {
                $query->where('country', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            })
            ->withCount('jobs')
            ->orderBy('country')
            ->orderBy('city')
            ->get();

        return view('admin.locations.index', compact('locations', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        Location::create([
            'country' => $request->country,
            'city' => $request->city,
        ]);

        return back()->with('success', 'Location created successfully.');
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $location->update([
            'country' => $request->country,
            'city' => $request->city,
        ]);

        return back()->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return back()->with('success', 'Location deleted successfully.');
    }
}

