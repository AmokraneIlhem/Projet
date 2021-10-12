<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Models\Role;
use App\Models\User;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {  setlocale(LC_TIME, 'fr_FR');
        $fournisseurs= DB::table('fournisseurs')->count(); 
        $users= DB::table('users')->count();
        $struct= DB::table('structures')->count();
        $factures= DB::table('factures')->count();
       


        $chart=(new LarapexChart)
        ->lineChart()->setTitle('Nombre de Factures')
        
         ->addLine('Factures En cours', \App\Models\Facture::select(DB::raw("COUNT(*) as count,Month(created_at) as month"))
         ->where("etat","like","0")
         ->whereYear("created_at",date('Y'))
         ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count')->toArray())
       ->addLine('Factures Cloturé',  \App\Models\Facture::select(DB::raw("COUNT(*) as count,Month(created_at) as month"))
        ->where("etat","like","1")
        ->whereYear("created_at",date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
       ->pluck('count')->toArray())
      ->setXAxis(['Janvier', 'Féverier', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'])
         ->setColors([ '#ff6384','#ffc63b']);
        // dd($chart); 
        
        $chartUser=(new LarapexChart)->pieChart()
        ->setTitle('')
      
        ->addData(
            [
            
            \App\Models\Facture::where('etat', '=', '1')->sum('montant'),
            \App\Models\Facture::where('etat', '=', '0')->sum('montant')
        ])
        ->setColors(['#ffc63b', '#ff6384'])
        ->setLabels(['Somme payée', 'Somme réstante']);

        $chartProfil= (new LarapexChart)
        ->lineChart()->setTitle('Nombre Factures/Utilisateurs')
        
         ->addLine('Utilisateurs', \App\Models\User::select(DB::raw("COUNT(*) as count ,  Month(created_at) as month"))
         ->whereYear("created_at",date('Y'))
         ->groupBy('month')
         ->orderBy('month')
        ->pluck( 'month')
       ->toArray())
        ->addLine('Fournisseurs', \App\Models\Fournisseur::select(DB::raw("COUNT(*) as count ,  Month(created_at) as month"))
       ->whereYear("created_at",date('Y'))
        ->groupBy('month')
        ->orderBy('month')
       ->pluck( 'month')
      ->toArray())
       ->setXAxis(['Janvier', 'Féverier', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre']);

     

        return view('dashboard',compact('fournisseurs','users','struct','factures','chartUser','chart','chartProfil'));
    }
}
