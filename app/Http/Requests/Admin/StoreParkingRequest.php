<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreParkingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $parkingId = $this->route('parking')?->id;

        return [
            'name'           => ['required', 'string', 'max:255'],
            'slug'           => ['required', 'string', 'max:255', 'unique:parkings,slug,' . $parkingId],
            'city_slug'      => ['required', 'string', 'max:100'],
            'capacity'       => ['required', 'integer', 'min:0'],
            'type'           => ['required', 'in:surface,sous-sol,autre'],
            'levels'         => ['nullable', 'string', 'max:100'],
            'location'       => ['nullable', 'string', 'max:255'],
            'short_location' => ['nullable', 'string', 'max:100'],
            'address'        => ['nullable', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'schedule'       => ['nullable', 'string', 'max:255'],
            'rates'          => ['nullable', 'string', 'max:255'],
            'lat'            => ['nullable', 'numeric', 'between:-90,90'],
            'lng'            => ['nullable', 'numeric', 'between:-180,180'],
            'maps_url'       => ['nullable', 'url', 'max:500'],
            'is_active'      => ['boolean'],
            'sort_order'     => ['integer', 'min:0'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Le nom du parking est obligatoire.',
            'slug.required'     => 'Le slug est obligatoire.',
            'slug.unique'       => 'Ce slug est déjà utilisé.',
            'city_slug.required'=> 'La ville est obligatoire.',
            'capacity.required' => 'La capacité est obligatoire.',
            'type.required'     => 'Le type de parking est obligatoire.',
            'type.in'           => 'Le type doit être : surface, sous-sol ou autre.',
            'lat.between'       => 'La latitude doit être entre -90 et 90.',
            'lng.between'       => 'La longitude doit être entre -180 et 180.',
            'image.image'       => 'Le fichier doit être une image.',
            'image.max'         => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
