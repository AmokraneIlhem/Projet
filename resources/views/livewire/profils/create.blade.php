 <div class="row p-4 pt-5">
          <div class="col-12">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Nouveau Profil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" wire:submit.prevent="addProfil()">
               
                   <div class="card-body">
                  <div class="form-group">
                    <label>Profil</label>
                    <input type="text" wire:model="newProfil.name" class="form-control @error('newProfil.name') is-invalid @enderror" >
                    @error('newProfil.name')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="submit" class="btn btn-default float-right" wire:click="goToListProfil()">Retour</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
            </div>