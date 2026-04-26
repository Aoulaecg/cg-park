<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AppelOffre extends Model
{
    protected $table = 'appels_offres';

    protected $fillable = [
        'titre',
        'numero',
        'objet',
        'description',
        'date_publication',
        'date_limite',
        'statut',
        'fichier_path',
        'fichier_nom',
        'sort_order',
    ];

    protected $casts = [
        'date_publication' => 'date',
        'date_limite'      => 'date',
        'sort_order'       => 'integer',
    ];

    public function scopeOuvert(Builder $query): Builder
    {
        return $query->where('statut', 'ouvert');
    }

    public function getDateLimiteFormattedAttribute(): string
    {
        return $this->date_limite ? $this->date_limite->format('d/m/Y') : '';
    }

    public function getDatePublicationFormattedAttribute(): string
    {
        return $this->date_publication ? $this->date_publication->format('d/m/Y') : '';
    }
}
