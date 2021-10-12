<div class="row p-4 pt-5">
            <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck fa-1x"></i> Formulaire Création Nouvel Fournisseur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="addFournisseur()">
                <div class="card-body">
                     <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Nom</label>
                            <input type="text" wire:model="newfournisseur.nom" class="form-control @error('newfournisseur.nom') is-invalid @enderror">

                            @error("newfournisseur.nom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label >Prenom</label>
                            <input type="text" wire:model="newfournisseur.prenom" class="form-control @error('newfournisseur.prenom') is-invalid @enderror">

                            @error("newfournisseur.prenom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                 

                  <div class="form-group">
                    <label >Adresse e-mail</label>
                    <input type="text" class="form-control @error('newfournisseur.email') is-invalid @enderror" wire:model="newfournisseur.email">
                    @error("newfournisseur.email")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                  </div>

                  <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label >Telephone</label>
                            <input type="text" class="form-control @error('newfournisseur.tel') is-invalid @enderror" wire:model="newfournisseur.tel">
                            @error("newfournisseur.tel")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                    </div>

                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="button" wire:click="goToListFournisseur()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
