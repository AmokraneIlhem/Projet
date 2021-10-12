<?php

namespace App\Http\Livewire;

use App\Models\Facture;
use Livewire\Component;
use App\Models\Structure;
use App\Models\Fournisseur;
use Livewire\WithPagination;

class Employe extends Component
{
    use WithPagination; 
    public $currentPage=LISTPAGE;
    public $search=""; 
    public $newFacture=[];  
    public $newValue = "";
     protected $paginationTheme="bootstrap";
    public function render()
    {    
        $searchCritère="%".$this->search."%"; 
        $data=[
            "factures"=>Facture::where("montant","like",$searchCritère)->latest()->paginate(5),
            "fournisseurs"=>Fournisseur::all() ,
            "structures"=>Structure::all()
        ];
         return view('livewire.employe.index',$data)->extends('layouts.master')->section('contenu');
     
    }
    public function rules()
    {
    if($this->currentPage==CREATEFORMPAGE){
    return[ 'newFacture.montant'=>'required',
    'newFacture.fournisseur_id' => 'required',
    'newFacture.structure_id' =>'required',
    'newFacture.dateDebut' =>'required',
    'newFacture.dateFin' =>'required'
    
    ]; 
    } }
     public function goToAddFacture(){
        $this->currentPage=CREATEFORMPAGE;
       }
    public function goToListFacture(){
        $this->currentPage=LISTPAGE;
       
    }
    public function addFacture(){
    
        $validationAttributes=$this->validate(); 
        $validationAttributes["newFacture"]["etat"]="0";  
       Facture::create($validationAttributes["newFacture"]); 
          $this->newFacture=[]; 
          $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Facture créé avec succès!"]);
     }
     public function confirmDelete($id){
           
       $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
             "text" => "Vous êtes sur le point de supprimer la facture. Voulez-vous continuer?",
             "title" => "Êtes-vous sûr de continuer?",
             "type" => "warning",
             "data" => [
                 "facture_id" => $id
             ]
         ]]);
     }
     public function deleteFacture($id){
       Facture::destroy($id);
     
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Facture supprimé avec succès!"]);
     }
     public function updateFacture(Facture $facture){
        $this->newValue = "1";
        $validated = $this->validate([
            "newValue" => ["required"]
        ]);
        $facture->update(["etat"=> $validated["newValue"]]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Facture mise à jour avec succès!"]);
    }
}
