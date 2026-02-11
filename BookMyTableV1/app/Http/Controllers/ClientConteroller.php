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
 
    // public function storefavori(Request $request)
    // {
    //     $client = Auth()->user();
    //     $restuarant  = $client->restuarants->toggle($request->restaurant_id);
    //     if($client->load('restuarants')->contains($request->restaurant_id)){
    //         return back()->with('success', 'Restaurant ajouté aux favoris.');
    //     }
    //     else{
    //         return back()->with('success', 'Restaurant retiré des favoris.');
    //     }

    // }

    public function storefavori(Request $request)
{
    $request->validate([
        'restaurant_id' => 'required|exists:restaurants,id',
    ]);

    $client = auth()->user();

    $client->restaurants()->toggle($request->restaurant_id);

    $client->load('restaurants');

    $message = $client->restaurants->contains($request->restaurant_id)
        ? 'Restaurant ajouté aux favoris.'
        : 'Restaurant retiré des favoris.';

    return back()->with('success', $message);
}

}