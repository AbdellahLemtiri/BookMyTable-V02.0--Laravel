<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminDashboardConteroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        $users_count = User::where('role', 'restaurateur')->orWhere('role', 'client')->count();
        return view('dashboard_admin', compact('restaurants', 'users_count'));
    }

    /**
     * Show the gestion of users.
     */

    public function gestion()
    {
        $users = User::all()->where('role', '!=', 'admin');
        return view('gestionusers', compact('users'));
    }
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:client,restaurateur,visiteur',
        ]);

        $user->update([
            'role' => $validated['role']
        ]);
        $user->syncRoles($validated['role']);
        return redirect()->back()->with('success', "Le rôle de {$user->username} a été mis à jour.");
    }

    public function destroyUser(User $user)
    {
        $user->update([
            'is_active' => false
        ]);
        return redirect()->back()->with('success', "L'utilisateur a été supprimé.");
    }

    public  function destroyRestaurant(Restaurant $restaurant)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', "Action non autorisée.");
        }
        if ($restaurant->image) {
            Storage::disk('public')->delete($restaurant->images);
        }
        $restaurant->delete();
        return redirect()->route('admin.restaurants')->with('success', 'Restaurant supprimé avec succès.');
    }
}
