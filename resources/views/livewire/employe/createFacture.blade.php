<div  class="row " >
<div class="col-12">
<div class="card card-primary center">
              <div class="card-header">
                <h4 class="card-title  "><i class="nav-icon fa fa-file "></i> Nouvelle Facture</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" wire:submit.prevent="addFacture()">
                <div class="card-body">
                  <div class="form-group">
                    <label>Montant</label>
                    <input type="text" wire:model="newFacture.montant" class="form-control @error('newFacture.montant') is-invalid @enderror" >
                    @error('newFacture.montant')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
               
                      
                  
                  <div class="form-group ">
                    <label>Fournisseur</label>
                      <select class="form-control @error('newFacture.fournisseur_id') is-invalid @enderror" wire:model="newFacture.fournisseur_id" >
                        <option value="">---------</option>
                           @foreach ($fournisseurs as $fournisseur )
                        <option value="{{$fournisseur->id}}">{{$fournisseur->nom}} {{$fournisseur->prenom}}</option>
                          @endforeach
                    </select>
                      @error('newFacture.fournisseur_id')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
                
                 
                         <div class="form-group">
                      <label >Structure</label>
                      <select class="form-control @error('newFacture.structure_id') is-invalid @enderror" wire:model="newFacture.structure_id" >
                        
                       <option value="">---------</option>
                        @foreach ($structures as $structure )
                     <option value="{{$structure->id}}">{{$structure->libelle}}</option>
                          @endforeach
                    </select>
                      @error('newFacture.structure_id')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                    </div>
                
                   <div class="form-group">
                    <label>Date Début</label>
                    <input type="date" wire:model="newFacture.dateDebut" class="form-control @error('newFacture.dateDebut') is-invalid @enderror" >
                    @error('newFacture.dateDebut')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
             <div class="form-group">
                    <label>Date Fin</label>
                    <input type="date" wire:model="newFacture.dateFin" class="form-control @error('newFacture.dateFin') is-invalid @enderror" >
                    @error('newFacture.dateFin')
                  <span class="text-danger"> {{$message}}</span>       
                    @enderror
                  </div>
             
                <!-- /.card-body -->

               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                  <button type="button" wire:click="goToListFacture()" class="btn btn-danger">Retour</button>
                </div>
              </form>
            </div>
               
</div> 
</div>



