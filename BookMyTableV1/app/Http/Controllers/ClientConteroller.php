<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ClientConteroller extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function mesFavoris(Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'client') {
            $client = Client::find(auth()->id());
            $restaurants = $client->restaurants()->with('typeCuisine')->get();
            return view('favoris', compact('restaurants'));
        } else {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    }
    public function storefavori(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if (auth()->check() && auth()->user()->role === 'client') {
            $client = Client::find(auth()->id());
            $restaurant = Restaurant::find($request->restaurant_id);
            $client->restaurants()->toggle($restaurant->id);
            if ($client->restaurants->contains($restaurant->id)) {
                return redirect()->back()->with('success', 'Restaurant ajouter avec succès.');
            } else {
                return redirect()->back()->with('success', 'Restaurant supprimé avec succès.');
            }
        } else {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    }
}
