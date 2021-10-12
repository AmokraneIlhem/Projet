<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;
    protected $fillable = [
      'libelle',
      'description',
      
  ];

    public function users(){
    return $this->belongsToMany(User::class);
    } 
    public function factures(){
      return $this->hasMany(Facture::class); 
    }
}
