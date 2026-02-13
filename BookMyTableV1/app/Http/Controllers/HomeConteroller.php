<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class HomeConteroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $restaurants = Restaurant::with('typeCuisine')->latest()->get();
    $client = auth()->user();

    if ($client) {
        $client->load('restaurants');

        foreach ($restaurants as $restaurant) {
            $restaurant->is_liked = $client->restaurants->contains($restaurant->id);
        }
    }

    return view('home', compact('restaurants'));
}


    /** 
     * Search restaurants based on criteria.
     */
    public function search(Request $request)
    {
        $query = Restaurant::query();

        if ($request->has('search')) {
            $query->where('nom_restaurant', 'like', '%' . $request->search . '%')
                ->orWhere('adresse_restaurant', 'like', '%' . $request->search . '%')
                ->orWhere('description_restaurant', 'like', '%' . $request->search . '%');
                
        }

        $restaurants = $query->get(); //latest()->get();
        $client = auth()->user();
        return view('home', compact('restaurants'));
    }
}
