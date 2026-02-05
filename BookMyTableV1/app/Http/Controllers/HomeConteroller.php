<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeConteroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with('typeCuisine')->latest()->get();
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

        return view('home', compact('restaurants'));
    }
}
