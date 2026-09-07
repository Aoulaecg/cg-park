<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppelOffreDownload extends Model
{
    protected $fillable = [
        'appel_offre_id',
        'company_name',
    ];

    public function appelOffre(): BelongsTo
    {
        return $this->belongsTo(AppelOffre::class);
    }
}