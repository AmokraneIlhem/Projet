<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    public function structure(){
        return $this->belongsTo(Structure::class); 
    }
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class); 
    }
}
