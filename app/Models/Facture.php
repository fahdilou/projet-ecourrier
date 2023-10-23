<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = ['id','fournisseur', 'date_facture', 'date_arriver_facture', 'numero_facture', 'devise', 'montant', 'commentaire', 'who_create', 'etat_workflow', 'etat_traitement'];

    public function etatFactures()
    {
        return $this->hasMany(EtatFacture::class);
    }
}
