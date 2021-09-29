
<div wire:ignore.self>

@if($currentPage==CREATEFORMPAGE)
<div  class="row p-4 pt-5" >
<div class="col-12">
<div class="card card-primary center">
              <div class="card-header">
                <h4 class="card-title  "><i class=" fas fa-user-plus fa-1x"></i>Formulaire de création d'un nouvel utilisateur</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="addUser()">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" wire:model="newUser.name" class="form-control @error('newUser.name') is-invalid @enderror" >
                    @error('newUser.name')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                  <div class="form-group ">
                    <label>Sexe</label>
                      <select class="form-control @error('newUser.sexe') is-invalid @enderror" wire:model="newUser.sexe" >
                        <option value="">---------</option>
                        <option value="1">Homme</option>
                        <option value="0">Femme</option>
                    </select>
                      @error('newUser.sexe')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                  <div class="form-group">
                      <label >Adresse e-mail</label>
                    <input type="text" class="form-control @error('newUser.email') is-invalid @enderror" wire:model="newUser.email">
                      @error('newUser.email')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                    </div>

                    
                  <div class="form-group">
                        <div class="form-group ">
                            <label >Telephone </label>
                            <input type="text" class="form-control @error('newUser.tel') is-invalid @enderror" wire:model="newUser.tel">
                              @error('newUser.tel')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                          </div>
                          
                    <label>Role</label>
                      <select class="form-control @error('newUser.role_id') is-invalid @enderror" wire:model="newUser.role_id" >
                        <option value="">---------</option>
                        <option value="2">Manager</option>
                        <option value="3">Employé</option>
                    </select>
                      @error('newUser.role_id')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                   <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="text" class="form-control" disabled placeholder="Password" >
                  </div>
                </div>
                <!-- /.card-body -->

               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
               
</div> 
</div>
<script>
 window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
</script>
@endif

@if ($currentPage==LISTPAGE)
   <div class="row p-4 pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des utilisateurs</h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddUser()"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a>
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th style="width:5%;"></th>
                      <th style="width:25%;">Utilisateurs</th>
                      <th style="width:20%;" >Roles</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($users as $user)
                    <tr>
                      <td>
                       @if($user->sexe == "0")
                            <img src="{{asset('images/woman.png')}}" width="24"/>
                        @else
                            <img src="{{asset('images/man.png')}}" width="24"/>
                        @endif
                        </td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->role->name}}</td>
                      <td><span class="tag tag-success">{{ $user->created_at->diffForHumans() }}</span></td>
                      <td class="text-center">
                        <button class="btn btn-link" wire:click="goToEditUser({{$user->id}})"> <i class="far fa-edit"></i> </button>
                        <button class="btn btn-link" wire:click="confirmDelete('{{ $user->name }} ', {{$user->id}})" > <i class="far fa-trash-alt"></i> </button>
                         <button class="btn btn-link" wire:click="goToResetpassword({{$user->id}})"  > <i class="fa fa-key" aria-hidden="true"></i> </button>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


<script>
window.addEventListener("showConfirmMessage",event=>{
Swal.fire({
  title: "Êtes-vous sûr de continuer?",
  text: event.detail.message.text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Continuer',
   cancelButtonText:'Annuler'
}).then((result) => {
  if (result.isConfirmed) {
     @this.deleteUser(event.detail.message.data.user_id)
  }
})
window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
})
 
   
    
    
</script>
@endif
@if ($currentPage==EDITFORMPAGE)

<div  class="row p-4 " >
<div class="col">
<div class="card card-primary center">
              <div class="card-header">
                <h4 class="card-title  "><i class=" fas fa-user-plus fa-1x"></i>Formulaire d'édition d'un  utilisateur</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="updateUser()"method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" wire:model="EditUser.name" class="form-control @error('EditUser.name') is-invalid @enderror" >
                    @error('EditUser.name')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                  <div class="form-group ">
                    <label>Sexe</label>
                      <select class="form-control @error('EditUser.sexe') is-invalid @enderror" wire:model="EditUser.sexe" >
                        <option value="">---------</option>
                        <option value="1">Homme</option>
                        <option value="0">Femme</option>
                    </select>
                      @error('EditUser.sexe')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                  <div class="form-group">
                      <label >Adresse e-mail</label>
                    <input type="text" class="form-control @error('EditUser.email') is-invalid @enderror" wire:model="EditUser.email">
                      @error('EditUser.email')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                    </div>

                    
                  <div class="form-group">
                        <div class="form-group ">
                            <label >Telephone </label>
                            <input type="text" class="form-control @error('EditUser.tel') is-invalid @enderror" wire:model="EditUser.tel">
                              @error('EditUser.tel')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                          </div>
                          
                    <label>Role</label>
                      <select class="form-control @error('EditUser.role_id') is-invalid @enderror" wire:model="EditUser.role_id" >
                        <option value="">---------</option>
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Employé</option>
                    </select>
                      @error('EditUser.role_id')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                 
                <!-- /.card-body -->

               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                  <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
               
</div> 
</div>


 <div class="row">
  <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Permissions</h3>
                    <button class="btn bg-gradient-success" wire:click="updateRoleAndPermissions"><i class="fas fa-check"></i> Appliquer les modifications</button>
                    </div>
                    <!-- /.card-header -->
                      <div class="card-body">
                            <div id="accordion">
                                    @foreach($rolePermissions["permissions"] as $permission)
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h4 class="card-title flex-grow-1">
                                            <a  data-parent="#accordion" href="#"  aria-expanded="true">
                                                {{ $permission["permission_nom"]}}
                                            </a>
                                            </h4>
                                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">

                                                <input type="checkbox" class="custom-control-input"
                                                    @if($permission["active"]) checked @endif
                                                    wire:model.lazy="rolePermissions.permissions.{{$loop->index}}.active"
                                                    id="customSwitchPermission{{$permission['permission_id']}}">
                                                <label class="custom-control-label" for="customSwitchPermission{{$permission['permission_id']}}"> {{ $permission["active"]? "Activé" : "Desactivé" }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                    </div>

                  
                </div>
           </div>
      </div>
                 
<script>
 window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
</script>
  
@endif
@if ($currentPage==RESETPAGE)
   
        <div class="row p-4 mt-5">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="#" class="btn btn-link" wire:click.prevent="confirmPwdReset()">Réinitialiser le mot de passe</a>
                                <span>(par défaut: "password") </span>
                            </li>
                        </ul>
                    </div>
                </div>
            

<script>
window.addEventListener("showConfirmMessage",event=>{
Swal.fire({
  title: "Êtes-vous sûr de continuer?",
  text: event.detail.message.text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Continuer',
   cancelButtonText:'Annuler'
}).then((result) => {
  if (result.isConfirmed) {
     @this.resetPassword()
  }
})
window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
})
 
   
    
    
</script>
@endif
</div>
 
