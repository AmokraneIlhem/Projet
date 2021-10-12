<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Profils extends Component
{ use WithPagination;
  public $isAddProfil=false; 
  public $newValue = "";
  public $rolePermissions = [];
  protected $paginationTheme="bootstrap"; 
  public $newProfil=''; 
 public $curentPage=LISTPAGE; 
  public $search=''; 
  public $searchuser=''; 
  public $selectedProfil;
  public $EditRole=[]; 
  public $EditPer=[]; 
  public $DeleteRole=[]; 
  public $id_role,$rolePer; 
  public $Role=[]; 
  public $Users=[]; 
    public function render()
    {  $searchcritère="%".$this->searchuser."%"; 
      $searchCritère="%".$this->search."%"; 
      $data=[
          "roles"=>Role::where("name","like",$searchCritère)->latest()->paginate(5),
          "users"=>User::where("name","like",$searchcritère)->latest()->paginate(5)
      ];
      return view('livewire.profils.index',$data)->extends('layouts.master')->section('contenu');
       
    }
  
  public function rules(){
    return [ 'EditRole.role_id' =>'required']; 
  
  }
  public function goToListUser($id){
    $this->curentPage = CREATEFORMPAGE; 
    $this->Role = Role::find($id); 
    $this->Users= $this->Role->users; 
  }

  public function showuser(Role $profil){
 
    $this->selectedProfil =  $profil;
    $this->id_role = $profil->id; 
    //dd( $this->users); 
    $this->dispatchBrowserEvent("showModal", []);
  
  
  }

  public function updateRole($id){
    
    $this->EditRole = User::find($id)->toArray();
    $this->EditRole['role_id']= $this->id_role; 
    $validationAttributes=$this->validate();
    User::find($this->EditRole["id"])->update($validationAttributes["EditRole"]);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil attribué avec succès!"]);
  }
  public function deleteRole($id){
    $this->DeleteRole = User::find($id)->toArray();
   $this->DeleteRole['role_id']= 0; 
    $validationAttributes=$this->validate();
    User::find($this->DeleteRole["id"])->update($validationAttributes["DeleteRole"]);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil retiré!"]);
  }
  public function goToListProfil(){
    $this->curentPage=LISTPAGE;
   
  }
  public function goToEditPer(Role $profil){
    $this->curentPage=EDITFORMPAGE;
   $this->EditPer=$profil;
   $this->populateRolePermissions();
  }


public function toggleShowAddProfilForm(){
  if($this->isAddProfil){
     $this->isAddProfil = false;
     $this->newProfil =[];
     $this->resetErrorBag(["newProfil"]);
    
  }else{
     $this->isAddProfil = true;
  }
}
  public function addProfil(){
    $validated = $this->validate([
      "newProfil" => "required|unique:roles,name"
  ]);
  Role::create(["name"=> $validated["newProfil"]]);
      $this->toggleShowAddProfilForm();
      $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil créé avec succès!"]);
   }



public function editProfil(Role $profil){
  $this->dispatchBrowserEvent("showEditForm", ["profil" => $profil]);
}

public function updateProfil(Role $profil, $valueFromJS){
  $this->newValue = $valueFromJS;
  $validated = $this->validate([
      "newValue" => ["required", Rule::unique("roles", "name")->ignore($profil->id)]
  ]);

  $profil->update(["name"=> $validated["newValue"]]);

  $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil mis à jour avec succès!"]);

}
public function confirmDelete($name, $id){
      
  $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
        "text" => "Vous êtes sur le point de supprimer le profil ' $name '. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning",
        "data" => [
            "role_id" => $id
        ]
    ]]);
}
public function deleteProfil($id){
  Role::destroy($id);

   $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil supprimé avec succès!"]);
}

  public function closeModal(){
        $this->dispatchBrowserEvent("closeModal", []);
    }


    public function populateRolePermissions(){
      $this->rolePermissions["roles"] = [];
      $this->rolePermissions["permissions"] = [];
  
      $mapForCB = function($value){
          return $value["id"];
      };
      $permissionIds = array_map($mapForCB, Role::find($this->EditPer["id"])->permissions->toArray()); // [1, 2, 4]
      foreach(Permission::all() as $permission){
          if(in_array($permission->id, $permissionIds)){
              array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>true]);
             
          }else{
              array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>false]);
             
          }
      } 
}

public function updateRoleAndPermissions(){
  
  DB::table("permission_role")->where("role_id", $this->EditPer["id"])->delete();

  foreach($this->rolePermissions["permissions"] as $permission){
      if($permission["active"]){
          Role::find($this->EditPer["id"])->permissions()->attach($permission["permission_id"]);
      }
  }

  $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>" Permissions mise à jour avec succès!"]);
} 
}
