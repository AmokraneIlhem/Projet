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
                          
                    {{-- <label>Role</label>
                      <select class="form-control @error('newUser.role_id') is-invalid @enderror" wire:model="newUser.role_id" >
                        <option value="">---------</option>
                        <option value="2">Manager</option>
                        <option value="3">Employé</option>
                    </select>
                      @error('newUser.role_id')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror --}}
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



