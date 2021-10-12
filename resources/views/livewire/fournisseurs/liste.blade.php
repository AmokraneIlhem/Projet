 <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-truck"></i> Liste des Fournisseurs</h3>

                <div class="card-tools d-flex align-items-center ">
                 @if( auth()->User()->role->hasPermission('ajouter un fournisseur'))
                <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddFournisseur()"><i class="fa fa-plus"></i> Nouvel Fournisseur</a>
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
                      
                      <th style="width:25%;">Fournisseur</th>
                      <th style="width:20%;" >Téléphone</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($fournisseurs as $fournisseur)
                    <tr>
                      
                      <td>{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</td>
                      
                      <td>{{$fournisseur->tel}}</td>
                      <td><span class="tag tag-success">{{ $fournisseur->created_at->diffForHumans() }}</span></td>
                      <td class="text-center ">
                       @if( auth()->User()->role->hasPermission('editer un fournisseur'))
                        <button class="btn btn-link " name="Editer" wire:click="goToEditFournisseur({{$fournisseur->id}})"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editer le fournisseur"> <i class="far fa-edit"></i> </button>
                      @endif
                        @if (count($fournisseur->factures)==0 )
                        <button class="btn btn-link "name="delete" wire:click="confirmDelete('{{ $fournisseur->nom }} ', {{$fournisseur->id}})"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer le fournisseur" > <i class="far fa-trash-alt"></i> </button>  
                        @endif
                        
                        <button class="btn btn-link "wire:click="goToListFacture({{$fournisseur->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Afficher la liste des factures du fournisseur"> <i class="fa fa-file " aria-hidden="true"></i> </button>
                      
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer ">
                <div class="float-right ">
                    {{ $fournisseurs->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>