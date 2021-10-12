 <div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-sitemap fa-1x"></i> Liste des Structures</h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block"wire:click.prevent=" goToAddStructure()" ><i class="fa fa-plus"></i> Nouvelle Structure</a>
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
                      
                      <th style="width:15%;">Libellé</th>
                      <th style="width:35%;" >Description</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($structures as $structure)
                    <tr>
                      
                      <td>{{$structure->libelle}}</td>
                      <td>{{$structure->description}}</td>
                      <td><span class="tag tag-success">{{ $structure->created_at->diffForHumans() }}</span></td>
                      <td class="text-center">
                        <button class="btn btn-link " wire:click="goToEditStruct('{{ $structure->id}} ')"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editer la structure"> <i class="far fa-edit"></i> </button>
                        @if (count($structure->users)==0)
                           <button class="btn btn-link "wire:click="confirmDelete('{{ $structure->libelle }} ', {{$structure->id}})"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supprimer la structure"> <i class="far fa-trash-alt"></i> </button>
                        @endif
                       
                         <button class="btn btn-link " wire:click="goToListUser('{{ $structure->id}} ')"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Afficher les utilisateurs liés à la structure"> <i class="fa fa-users" aria-hidden="true"></i></button>
                         <button class="btn btn-link " wire:click="goToListFacture('{{ $structure->id}} ')"> <i class="nav-icon fa fa-file" aria-hidden="true"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Afficher l'ensemble des factures de la structure"></i></button>
                      
                         </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
                  <div class="card-footer">
                <div class="float-right">
                    {{ $structures->links() }}
                </div>
              </div>
            </div>
              
            <!-- /.card -->
          </div>
        </div>