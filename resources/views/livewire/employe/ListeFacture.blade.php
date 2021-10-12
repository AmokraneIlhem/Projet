<div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="nav-icon fa fa-file "></i> Liste des Factures</h3>

                <div class="card-tools d-flex align-items-center ">
                      @if( auth()->User()->role->hasPermission('ajouter une facture'))
                <a class="btn btn-link text-white mr-4 d-block"wire:click.prevent="goToAddFacture()" ><i class="fas fa-plus"></i> Nouvelle Facture</a>
                @endif
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" wire:model.debounce="search" class="form-control float-right" placeholder="Search">

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
                      <th style="width:10%;">Montant </th>
                      <th style="width:20%;">Fournisseur</th>
                       <th style="width:20%;">Structure</th>
                      <th style="width:20%;" >Date Début</th>
                      <th style="width:20%;" class="text-center">Date Fin</th>
                       <th style="width:15%;" class="text-center">Etat</th>
                      <th style="width:40%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($factures as $facture)
                   @foreach (auth()->User()->structures as $structure )
                       @if($structure->id == $facture->structure->id)
                 
                    <tr>
                      
                      <td>{{$facture->montant }} DA</td>
                      <td>{{$facture->fournisseur->nom}} {{$facture->fournisseur->prenom}}</td>
                      <td>{{$facture->structure->libelle}}</td>
                      <td><span class="tag tag-success">{{ $facture->dateDebut }}</span></td>
                       <td><span class="tag tag-success">{{$facture->dateFin }}</span></td>
                       <td>
                       @if($facture->etat == "0")
                            En cours 
                        @else
                           Cloturé
                        @endif
                        </td>
                    <td class="text-center">
                     @if( auth()->User()->role->hasPermission('editer une facture'))
                      @if($facture->etat == "0")
                        <button class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cloturer la facture " > <i class="fa fa-check" wire:click="updateFacture({{$facture->id}})"></i> </button>
                      @endif
                      @endif
                       @if( auth()->User()->role->hasPermission('supprimer une facture'))
                       @if($facture->etat == "1")
                        <button class="btn btn-link" wire:click="confirmDelete( {{$facture->id}})"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer la facture"  > <i class="far fa-trash-alt"></i> </button>
                      @endif
                      @endif
                      </td>
                    </tr>
                    @endif
                      @endforeach
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $factures->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>