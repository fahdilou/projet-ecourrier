<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $fillable = ['num_ordre', 'type', 'libelle','who_create', 'who_update'];

    public function etatFactures()
    {
        return $this->hasMany(EtatFacture::class);
    }
}