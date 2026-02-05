<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_restaurant' => ['required', 'string', 'max:255'],
            'adresse_restaurant' => ['required', 'string', 'max:255'],
            'type_cuisine_id' => ['required', 'exists:type_cuisines,id'],
            'email_restaurant' => ['required', 'email', 'max:255'],
            'telephone_restaurant' => ['required', 'string', 'max:20'],
            'capacity' => ['required', 'integer', 'min:1'],
            'description_restaurant' => ['required', 'string', 'min:10'],

            'schedule' => ['required', 'array'],
            'schedule.*.open' => ['nullable', 'date_format:H:i'],
            'schedule.*.close' => ['nullable', 'date_format:H:i'], //after:schedule.*.open

            'image_principal' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

            'menu' => ['required', 'array', 'min:1'],
            'menu.*.nom_plat' => ['required', 'string', 'max:255'],
            'menu.*.prix_plat' => ['required', 'numeric', 'min:0'],
        ];
    }
}
