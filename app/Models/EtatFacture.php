<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EtatFacture extends Model
{
    protected $fillable = ['facture_id', 'workflow_id', 'etapetraitement_id','date_entree', 'date_sortie', 'who_update'];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}

