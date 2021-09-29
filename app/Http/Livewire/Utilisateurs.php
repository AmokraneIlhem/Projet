<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Utilisateurs extends Component
{ use WithPagination; 
   
    protected $paginationTheme="bootstrap"; 
    public $currentPage=LISTPAGE;
    public $newUser=[]; 
    public $Reset=[]; 
    public $EditUser=[]; 

protected $validationAttributes=[ 
    "newUser.name" => "Nom complet",
    'newUser.email' => "E-mail",
    'newUser.tel' =>'Telephone',
    'newUser.sexe' =>'Sexe',
    'newUser.role_id' =>'Role'


];
public function rules()
{
if($this->currentPage==CREATEFORMPAGE){
return[ 'newUser.name'=>'required',
'newUser.email' => 'required|email|unique:users,email',
'newUser.tel' =>'required|numeric|unique:users,tel',
'newUser.sexe' =>'required',
'newUser.role_id' =>'required'

]; 
} 
    return [ 'EditUser.name'=>'required',
    'EditUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->EditUser['id']) ],
    'EditUser.tel' =>['required', 'numeric', Rule::unique("users", "tel")->ignore($this->EditUser['id']) ] ,
    'EditUser.sexe' =>'required',
    'EditUser.role_id' =>'required'

]; 
}


    public function render()
    {
         return view('livewire.utilisateurs.index',[
             "users"=>User::latest()->paginate(4)
         ])->extends('layouts.master')->section('contenu'); 
    }
    public function goToAddUser(){
        $this->currentPage=CREATEFORMPAGE; 
    }
    public function goToResetpassword($id){
        $this->Reset = User::find($id)->toArray();
        $this->currentPage=RESETPAGE; 
    }
    public function goToEditUser($id){
        $this->EditUser = User::find($id)->toArray();
        $this->currentPage=EDITFORMPAGE;
    }
    public function goToListUser(){
        $this->currentPage=LISTPAGE;
        $this->EditUser = [];
    }
    /*---------------------------------------------*/
  //Ajouter un utilisateur
  public function addUser(){
   /****** vérifier que les infos envoyées par le form sont correctes ******/
         $validateAttributes=$this->validate(); 
          $validateAttributes["newUser"]["password"]=Hash::make(DEFAULTPASSOWRD); 
    /********** ajouter un nouvel user *************/
      User::create($validateAttributes["newUser"]); 
     $this->newUser=[]; 
     $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur créé avec succès!"]);
  }
  /****** Confirme la suppression ******/
  public function confirmDelete($name, $id){
      
  $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
        "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning",
        "data" => [
            "user_id" => $id
        ]
    ]]);
}
  /****** ************* Supprime l'utilisateur *********************/
public function deleteUser($id){
   User::destroy($id);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur supprimé avec succès!"]);
}

 /****** ************* Supprime l'utilisateur *********************/
public function updateUser(){
    $validateAttributes=$this->validate();
    User::find($this->EditUser["id"])->update($validateAttributes["EditUser"]);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur mis à jour avec succès!"]);


}

public function confirmPwdReset(){
    $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
        "text" => "Vous êtes sur le point de réinitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning"
    ]]);
}

public function resetPassword(){

    User::find($this->Reset["id"])->update(["password" => Hash::make(DEFAULTPASSOWRD)]);
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mot de passe utilisateur réinitialisé avec succès!"]);
}


}
        

