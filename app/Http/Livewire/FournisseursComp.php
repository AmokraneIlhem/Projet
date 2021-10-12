<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class FournisseursComp extends Component
{use WithPagination; 
    public $search=""; 
     protected $paginationTheme="bootstrap"; 
     public $currentPage=LISTPAGE;
     public $newfournisseur=[]; 
    public $factures; 
     public $Editfournisseur=[]; 
     public $fournisseur;
    public function render()
    { 
        $searchCritère="%".$this->search."%"; 
        $data=[
            "fournisseurs"=>Fournisseur::where("nom","like",$searchCritère)->latest()->paginate(5)
        ];
         return view('livewire.fournisseurs.index',$data)->extends('layouts.master')->section('contenu'); 
        
    }
    public function goToEditFournisseur($id){
        $this->Editfournisseur = Fournisseur::find($id)->toArray();
        $this->currentPage=EDITFORMPAGE;
       
    }
    protected $validationAttributes=[ 
        "newfournisseur.nom" => "Nom ",
        'newUser.email' => "E-mail",
        'newUser.tel' =>'Telephone',
        'newfournisseur.prenom' =>'Prénom',
        
    
    
    ];
    public function goToListFacture(Fournisseur $fournisseur){
        $this->currentPage=FACTUREPAGE; 
        $this->fournisseur=$fournisseur; 
       
        $this->factures=$fournisseur->factures; 
    }
    public function goToListFournisseur(){
        $this->currentPage=LISTPAGE; 
    }
    public function goToAddFournisseur(){
        $this->currentPage=CREATEFORMPAGE; 
    }
    public function rules()
    {
    if($this->currentPage==CREATEFORMPAGE){
    return[ 'newfournisseur.nom'=>'required',
    'newfournisseur.prenom'=>'required',
    'newfournisseur.email' => 'email|unique:fournisseurs,email',
    'newfournisseur.tel' =>'required|numeric|unique:fournisseurs,tel',
    ]; 
    }  if($this->currentPage==EDITFORMPAGE){
        return [ 'Editfournisseur.nom'=>'required',
        'Editfournisseur.prenom'=>'required',
        'Editfournisseur.email' => [ 'email', Rule::unique("fournisseurs", "email")->ignore($this->Editfournisseur['id']) ],
        'Editfournisseur.tel' =>['required', 'numeric', Rule::unique("fournisseurs", "tel")->ignore($this->Editfournisseur['id']) ] ,
       
    
    ]; }
    }
    public function addFournisseur(){
        /****** vérifier que les infos envoyées par le form sont correctes ******/
        $validationAttributes=$this->validate(); 
      
         /********** ajouter un nouvel fournisseur *************/
         Fournisseur::create($validationAttributes["newfournisseur"]); 
          $this->newfournisseur=[]; 
          $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Fournisseur créé avec succès!"]);
       }

       public function updateFournisseur(){
        $validationAttributes=$this->validate();
        Fournisseur::find($this->Editfournisseur["id"])->update($validationAttributes["Editfournisseur"]);
    
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Fournisseur mis à jour avec succès!"]);
    
    
    }
    public function confirmDelete($name, $id){
      
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
              "text" => "Vous êtes sur le point de supprimer $name de la liste des fournisseurs. Voulez-vous continuer?",
              "title" => "Êtes-vous sûr de continuer?",
              "type" => "warning",
              "data" => [
                  "fournisseur_id" => $id
              ]
          ]]);
      }

      public function deleteFournisseur($id){
        Fournisseur::destroy($id);
     
         $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Fournisseur supprimé avec succès!"]);
     }
}
