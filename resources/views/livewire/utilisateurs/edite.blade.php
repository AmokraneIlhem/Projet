<div  class="row" >
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


 
