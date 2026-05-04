<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppelOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'titre'            => ['required', 'string', 'max:255'],
            'numero'           => ['nullable', 'string', 'max:100'],
            'objet'            => ['required', 'string'],
            'description'      => ['nullable', 'string'],
            'date_publication' => ['nullable', 'date'],
            'date_limite'      => ['nullable', 'date'],
            'statut'           => ['required', 'in:ouvert,ferme,archive'],
            'sort_order'       => ['integer', 'min:0'],
            'fichier'          => [$isUpdate ? 'nullable' : 'nullable', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required'   => 'Le titre est obligatoire.',
            'objet.required'   => 'L\'objet est obligatoire.',
            'statut.required'  => 'Le statut est obligatoire.',
            'statut.in'        => 'Le statut doit être : ouvert, fermé ou archivé.',
            'fichier.mimes'    => 'Le fichier doit être un PDF, DOC, DOCX, ZIP ou RAR.',
            'fichier.max'      => 'Le fichier ne doit pas dépasser 20 Mo.',
        ];
    }
}
