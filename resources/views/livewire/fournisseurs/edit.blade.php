<div  class="row p-4" >
<div class="col">
<div class="card card-primary center">
              <div class="card-header">
                <h4 class="card-title  "><i class=" fa fa-truck fa-1x"></i>Formulaire Edition Fournisseur</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="updateFournisseur()"method="POST">
                <div class="card-body">
                  <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Nom</label>
                            <input type="text" wire:model="Editfournisseur.nom" class="form-control @error('Editfournisseur.nom') is-invalid @enderror">

                            @error("Editfournisseur.nom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label >Prenom</label>
                            <input type="text" wire:model="Editfournisseur.prenom" class="form-control @error('Editfournisseur.prenom') is-invalid @enderror">

                            @error("Editfournisseur.prenom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                 
                  <div class="form-group">
                      <label >Adresse e-mail</label>
                    <input type="text" class="form-control @error('Editfournisseur.email') is-invalid @enderror" wire:model="Editfournisseur.email">
                      @error('Editfournisseur.email')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                    </div>

                    
                  <div class="form-group">
                        <div class="form-group ">
                            <label >Téléphone </label>
                            <input type="text" class="form-control @error('Editfournisseur.tel') is-invalid @enderror" wire:model="Editfournisseur.tel">
                              @error('Editfournisseur.tel')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                          </div>
                          
                   
                 
                <!-- /.card-body -->

               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                  <button type="button" wire:click="goToListFournisseur()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
               