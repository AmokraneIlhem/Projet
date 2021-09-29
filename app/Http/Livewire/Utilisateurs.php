<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Utilisateurs extends Component
{ use WithPagination; 
   
    protected $paginationTheme="bootstrap"; 
    public $currentPage=LISTPAGE;
    public $newUser=[]; 
    public $Reset=[]; 
    public $EditUser=[]; 
    public $EditPermission=[]; 
    public $rolePermissions = [];

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
        $this->populateRolePermissions();
    }
    public function goToEditPermission($id){
        $this->EditPermission= User::find($id)->toArray();
       
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

public function populateRolePermissions(){
    $this->rolePermissions["roles"] = [];
    $this->rolePermissions["permissions"] = [];

    $mapForCB = function($value){
        return $value["id"];
    };

   // $roleIds = array_map($mapForCB, User::find($this->EditPermission["id"])->roles->toArray()); // [1, 2, 4]
    $permissionIds = array_map($mapForCB, User::find($this->EditUser["id"])->permissions->toArray()); // [1, 2, 4]

    // foreach(Role::all() as $role){
    //     if(in_array($role->id, $roleIds)){
    //         array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>true]);
    //     }else{
    //         array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>false]);
    //     }
    // }

    foreach(Permission::all() as $permission){
        if(in_array($permission->id, $permissionIds)){
            array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>true]);
        }else{
            array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>false]);
        }
    }


    // la logique pour charger les roles et les permissions
}




public function updateRoleAndPermissions(){
    //DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
    DB::table("permission_user")->where("user_id", $this->EditUser["id"])->delete();

    // foreach($this->rolePermissions["roles"] as $role){
    //     if($role["active"]){
    //         User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
    //     }
    // }

    foreach($this->rolePermissions["permissions"] as $permission){
        if($permission["active"]){
            User::find($this->EditUser["id"])->permissions()->attach($permission["permission_id"]);
        }
    }

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>" Permissions mise à jour avec succès!"]);
}

}
        

