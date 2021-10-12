<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["nom"=> "ajouter une facture"],
            ["nom"=> "consulter une facture"],
            ["nom"=> "supprimer une facture"],
            ["nom"=> "editer une facture"],
            ["nom"=> "ajouter un fournisseur"],
            ["nom"=> "consulter une fournisseur"],
            ["nom"=> "editer un fournisseur"],
            ["nom"=> "supprimer un fournisseur"],

            
        ]);
    
    }
}
