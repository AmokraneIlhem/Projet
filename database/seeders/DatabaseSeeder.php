<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Facture;
use App\Models\Structure;
use App\Models\Fournisseur;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class); 
        Structure::factory(6)->create();
        Fournisseur::factory(5)->create(); 
         Facture::factory(10)->create(); 
        User::factory(10)->create();
       
        User::find(1)->structures()->attach(1);
        User::find(2)->structures()->attach(2);
        User::find(3)->structures()->attach(3);
        User::find(4)->structures()->attach(4);

        Permission::find(1)->roles()->attach(1);
        Permission::find(2)->roles()->attach(2);
        Permission::find(3)->roles()->attach(3);
       


        // Structure::find(1)->users()->attach(1);
        // Structure::find(2)->users()->attach(2);
        // Structure::find(3)->users()->attach(3);
        // Structure::find(4)->users()->attach(4);
    }
}
