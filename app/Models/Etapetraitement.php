<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapetraitement extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Etapetraitement::class, 'parent_id');
    }

    public function etatFactures()
    {
        return $this->hasMany(EtatFacture::class);
    }
}