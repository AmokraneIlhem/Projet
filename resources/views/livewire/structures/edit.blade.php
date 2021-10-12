<div  class="row p-4 pt-5" >
<div class="col-12">
<div class="card card-primary center">
              <div class="card-header">
                <h4 class="card-title  "><i class=" nav-icon fa fa-sitemap  fa-1x"></i> Editer une Structure</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="updateStruct()">
                <div class="card-body">
                  <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" wire:model="EditStruct.libelle" class="form-control @error('EditStruct.libelle') is-invalid @enderror" >
                    @error('EditStruct.libelle')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                  <div class="form-group">
                        <div class="form-group ">
                            <label >Description </label>
                            <input type="text" class="form-control @error('EditStruct.description') is-invalid @enderror" wire:model="EditStruct.description">
                              @error('EditStruct.description')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                          </div>
                          
                  
                <!-- /.card-body -->

               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="button" wire:click="goToListStruct()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
               
</div> 
</div>