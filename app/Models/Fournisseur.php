<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    public function factures(){
        return $this->hasMany(Facture::class); 
    }
    protected $fillable = [
        'nom',
        'email',
        'prenom',
        'tel',
       
    ];
}
