<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Structure;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StructuresComp extends Component
{ use WithPagination; 
    public $search=""; public $searchuser=""; 
     protected $paginationTheme="bootstrap";
     public $newStruct=[]; 
     public $EditStruct=[]; 
     public $currentPage=LISTPAGE;
     public $users,$struct,$factures; 
     public $selectedStruct,$id_struct; 
/*************************************************************/     
    public function render()
    {  $searchcritère="%".$this->searchuser."%"; 
        $searchCritère="%".$this->search."%"; 
        $data=[
            "structures"=>Structure::where("libelle","like",$searchCritère)->latest()->paginate(3),
            "Users"=>User::where("name","like",$searchcritère)->latest()->paginate(5)
        ];
         return view('livewire.structures.index',$data)->extends('layouts.master')->section('contenu'); 
    }
    protected $validationAttributes=[ 
      "newStruct.description" => "Description",
      'newStruct.libelle'=> "Libellé",
     
  
  
  ];
  public function addUser(User $user){
    $user->structures()->attach( $this->id_struct);
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur ajouté avec succès!"]); 
  }
    public function rules()
    {
    if($this->currentPage==CREATEFORMPAGE){
    return[ 'newStruct.libelle'=>'required|unique:structures,libelle',
    'newStruct.description' => 'required',
    
    
    ]; 
    } 
    if($this->currentPage==EDITFORMPAGE){
        return [ 'EditStruct.description'=>'required',
        'EditStruct.libelle' => ['required', Rule::unique("structures", "libelle")->ignore($this->EditStruct['id']) ],
        
    
    ]; }
    }
    public function showuser(Structure $struct){
 
      $this->selectedStruct =  $struct;
      $this->id_struct= $struct->id; 
      //dd( $this->users); 
      $this->dispatchBrowserEvent("showModal", []);
    
    
    }
    public function closeModal(){
      $this->dispatchBrowserEvent("closeModal", []);
  }

    public function goToListUser(Structure $struct){
      $this->currentPage=USERPAGE; 
      $this->struct=$struct; 
      $this->users= $struct->users; 
     
    }
    public function goToListFacture(Structure $struct){
      $this->currentPage=FACTUREPAGE; 
      $this->struct=$struct; 
      $this->factures= $struct->factures; 
     
    }
    public function goToEditStruct(Structure $struct){
      $this->currentPage=EDITFORMPAGE; 
      $this->EditStruct=$struct; 
    }
    public function updateStruct(){
      $validationAttributes=$this->validate();
      Structure::find($this->EditStruct["id"])->update($validationAttributes["EditStruct"]);
  
      $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Structure mise à jour avec succès!"]);
    }
  public function goToListStruct(){
    $this->currentPage=LISTPAGE;
  }
    public function goToAddStructure(){
        $this->currentPage=CREATEFORMPAGE; 
    }
  /********** ajouter une nouvelle structure *************/
public function addStructure(){
    /****** vérifier que les infos envoyées par le form sont correctes ******/
    $validationAttributes=$this->validate(); 
          
     /********** ajouter un nouvel user *************/
       Structure::create($validationAttributes["newStruct"]); 
      $this->newStruct=[]; 
      $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Structure créé avec succès!"]);
   }
/************************************************* */
    public function confirmDelete($name, $id){
      
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
              "text" => "Vous êtes sur le point de supprimer $name de la liste des Structures. Voulez-vous continuer?",
              "title" => "Êtes-vous sûr de continuer?",
              "type" => "warning",
              "data" => [
                  "structure_id" => $id
              ]
          ]]);
      }
        /****** ************* Supprime l'utilisateur *********************/
      public function deleteStruct($id){
         Structure::destroy($id);
      
          $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Structure supprimé avec succès!"]);
      }
   
}
