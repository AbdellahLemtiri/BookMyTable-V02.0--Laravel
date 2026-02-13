<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{ 
    public function authorize(): bool
    {
        return true; 
    }
 
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'date_reservation' => 'required|date|after_or_equal:today', 
            'heure_reservation' => 'required', 
            'nb_personnes' => 'required|integer|min:1',  
        ];
    }
 
    public function messages(): array
    {
        return [
            'date_reservation.after_or_equal' => 'Vous ne pouvez pas réserver dans le passé.',
            'nb_personnes.min' => 'Il faut au moins 1 personne.',
            'restaurant_id.exists' => 'Ce restaurant n\'existe pas.',
        ];
    }
}