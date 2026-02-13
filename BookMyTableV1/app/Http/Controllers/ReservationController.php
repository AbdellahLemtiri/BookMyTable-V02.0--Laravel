<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Http\Requests\StoreReservationRequest;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ReservationController extends Controller
{ 
   
 
    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();
        $restaurant = Restaurant::findOrFail($data['restaurant_id']);
  
        $reservationsActuelles = Reservation::where('restaurant_id', $restaurant->id)
            ->where('date_reservation', $data['date_reservation'])
            ->where('heure_reservation', $data['heure_reservation'])
            ->where('statut', '!=', 'annulee')
            ->sum('nb_personnes');

        $capaciteMax = $restaurant->capacite_restaurant ?? 20;

        if (($reservationsActuelles + $data['nb_personnes']) > $capaciteMax) {
            return back()->with('error', 'Complet ! Choisissez une autre heure.');
        }
 
        $prix_par_personne = 20; 
        $total_a_payer = $data['nb_personnes'] * $prix_par_personne;

       
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurant->id,
            'date_reservation' => $data['date_reservation'],
            'heure_reservation' => $data['heure_reservation'],
            'nb_personnes' => $data['nb_personnes'],
            'statut' => 'en_attente',  
            'total_price' => $total_a_payer,
        ]);

       
        Stripe::setApiKey(env('STRIPE_SECRET'));  

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',  
                    'product_data' => [
                        'name' => 'Réservation : ' . $restaurant->nom_restaurant,
                        'description' => $data['nb_personnes'] . ' Personnes - ' . $data['date_reservation'] . ' à ' . $data['heure_reservation'],
                    ],'unit_amount' => $total_a_payer * 100, ],'quantity' => 1,]], 'mode' => 'payment',  
            'success_url' => route('reservations.success', ['reservation_id' => $reservation->id]),
            'cancel_url' => route('reservations.cancel', ['reservation_id' => $reservation->id]),
        ]);
 
        return redirect($session->url);
    }


    public function success($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

       
        if ($reservation->statut === 'en_attente') {
            $reservation->update(['statut' => 'payee']);
        }

        return view('reservations.confirmation', compact('reservation'));
    }

  
    public function cancel($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        
        if ($reservation->statut === 'en_attente') {
             $reservation->update(['statut' => 'annulee']);
        }

        return redirect()->route('home')->with('error', 'Paiement annulé, réservation non confirmée.');
    }

    public function confiramation($reservation_id)
    {
    $reservation = Reservation::findOrFail($reservation_id);

    return view('reservation.confirmation',compact($reservation));
    }

    public function history()
    {
        $reservations = Reservation::all();
        return view('reservations.history',compact('reservations'));
    }
}