<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        
        
    ];
    use HasFactory;
    public function users(){
        return $this->hasMany(User::class); 
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    public function hasPermission( $permission){
        return $this->permissions()->where("nom",$permission)->first(); 
    }
}
