<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\TypeCuisine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurant = Restaurant::with('typeCuisine')->latest()->get();
        return view('restaurant.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_cuisines = TypeCuisine::all();
        return view('restaurants.create', compact('type_cuisines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $validated = $request->validated(); 

        try {
            return DB::transaction(function () use ($validated, $request) {
                $restaurant = Restaurant::create([
                    'nom_restaurant' => $validated['nom_restaurant'],
                    'adresse_restaurant' => $validated['adresse_restaurant'],
                    'telephone_restaurant' => $validated['telephone_restaurant'],
                    'description_restaurant' => $validated['description_restaurant'],
                    'email_restaurant' => $validated['email_restaurant'],
                    'capacity' => $validated['capacity'],
                    'type_cuisine_id' => $validated['type_cuisine_id'],
                    'user_id' => Auth::id(),
                ]);

                if ($request->hasFile('image_principal')) {
                    $path = $request->file('image_principal')->store('photos', 'public');
                    $restaurant->photos()->create([
                        'url_photo' => $path,
                        'is_principal' => true,
                    ]);
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('photos', 'public');
                        $restaurant->photos()->create([
                            'url_photo' => $path,
                            'is_principal' => false,
                        ]);
                    }
                }

                if (isset($validated['schedule'])) {
                    foreach ($validated['schedule'] as $jour => $horaire) {
                        $isFerme = empty($horaire['open']) && empty($horaire['close']);

                        $restaurant->horaires()->create([
                            'jour' => ucfirst($jour),
                            'heure_ouverture' => $horaire['open'] ?? null,
                            'heure_fermeture' => $horaire['close'] ?? null,
                            'ferme' => $isFerme,
                        ]);
                    }
                }

                $menu = $restaurant->menus()->create([]);

                if (isset($validated['menu'])) {
                    foreach ($validated['menu'] as $menuItem) {
                        if (!empty($menuItem['nom_plat']) && !empty($menuItem['prix_plat'])) {
                            $menu->plats()->create([
                                'nom_plat' => $menuItem['nom_plat'],
                                'prix_plat' => $menuItem['prix_plat'],
                            ]);
                        }
                    }
                }

                return redirect()->route('restaurants.create')->with('success', 'Restaurant créé avec succès!');
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        // Charger toutes les relations nécessaires
        $restaurant->load([
            'photos',
            'menus.plats',
            'horaires',
            'typeCuisine'
        ]);

        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->user_id) {
            return redirect()->back()->with('error', "Action non autorisée.");
        }

        $type_cuisines = TypeCuisine::all();
        $restaurant->load(['photos', 'menus.plats', 'horaires']);

        return view('restaurants.edit', compact('restaurant', 'type_cuisines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->user_id) {
            return redirect()->back()->with('error', "Action non autorisée.");
        }

        $validated = $request->validated();

        try {
            return DB::transaction(function () use ($validated, $request, $restaurant) {
                $restaurant->update([
                    'nom_restaurant' => $validated['nom_restaurant'],
                    'adresse_restaurant' => $validated['adresse_restaurant'],
                    'telephone_restaurant' => $validated['telephone_restaurant'],
                    'description_restaurant' => $validated['description_restaurant'],
                    'email_restaurant' => $validated['email_restaurant'],
                    'capacity' => $validated['capacity'],
                    'type_cuisine_id' => $validated['type_cuisine_id'],
                ]);

                if (isset($validated['schedule'])) {
                    $restaurant->horaires()->delete();
                    foreach ($validated['schedule'] as $jour => $horaire) {
                        $isFerme = empty($horaire['open']) && empty($horaire['close']);

                        $restaurant->horaires()->create([
                            'jour' => ucfirst($jour),
                            'heure_ouverture' => $horaire['open'] ?? null,
                            'heure_fermeture' => $horaire['close'] ?? null,
                            'ferme' => $isFerme,
                        ]);
                    }
                }

                return redirect()->route('restaurants.show', $restaurant)
                    ->with('success', 'Restaurant mis à jour avec succès!');
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->user_id) {
            return redirect()->back()->with('error', "Action non autorisée.");
        }

        try {
            DB::transaction(function () use ($restaurant) {
                foreach ($restaurant->photos as $photo) {
                    Storage::disk('public')->delete($photo->url_photo);
                }
                $restaurant->delete();
            });

            return redirect()->route('restaurateur.dashboard')
                ->with('success', 'Restaurant supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
