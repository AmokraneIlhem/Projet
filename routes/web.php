<?php

use App\Models\Structure;
use App\Http\Livewire\Employe;
use App\Http\Livewire\Profils;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\FacturesComp;
use App\Http\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\StructuresComp;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FournisseursComp;
use App\Http\Controllers\usersController;
use ArielMejiaDev\LarapexCharts\LarapexChart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\usersController::class, 'index'])->name('users');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/chart', [App\Http\Controllers\chartController::class, 'index'])->name('chart');

Route::group([
    "middleware"=>["auth","auth.admin"], 
    "as"=>"admin."
],function(){
    Route::group(
        ["prefix"=>"habilitations",
        "as"=>"habilitations."
    ],function(){
        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        
      }
);
});
Route::group([
    "middleware"=>["auth","auth.admin"], 
    "as"=>"admin."
],function(){
    Route::group(
        ["prefix"=>"gestion",
        "as"=>"gestion."
    ],function(){
        Route::get("/factures", FacturesComp::class)->name("factures");
        Route::get("/structures", StructuresComp::class)->name("structures");
        Route::get("/fournisseurs", FournisseursComp::class)->name("fournisseurs");
        Route::get("/profils", Profils::class)->name("profils");
       
        
      }
);
});
// Route::group([
//     "middleware"=>["auth","auth.employe"], 
//     "as"=>"employe."
// ],function(){
    Route::group(
        ["prefix"=>"gestion",
        "as"=>"gestion."
    ],function(){
        Route::get("/index", Employe::class)->name("index");
       
    }
);
// });
