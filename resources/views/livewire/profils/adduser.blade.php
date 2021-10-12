<div class="modal fade" id="modalProp" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
              
                <div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h2 class="card-title flex-grow-1"><i class="fa fa-user-circle fa-2x"></i> {{ optional($selectedProfil)->name }} </h2>

                <div class="card-tools d-flex align-items-center ">
               
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" wire:model.debounce="searchuser" class="form-control float-right" placeholder="Search">

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
                      <th style="width:5%;"></th>
                      <th style="width:25%;">Utilisateurs</th>
                      <th style="width:20%;" >Roles</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($users as $user)
                    <tr>
                      <td>
                       @if($user->sexe == "0")
                            <img src="{{asset('images/woman.png')}}" width="24"/>
                        @else
                            <img src="{{asset('images/man.png')}}" width="24"/>
                        @endif
                        </td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->role->name}}</td>
                      <td><span class="tag tag-success">{{optional( $user->created_at)->diffForHumans() }}</span></td>
                      <td class="text-center">
                        <button class="btn btn-link " wire:click="updateRole({{$user->id}})"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajouter un utilisateur" > <i class="fa fa-plus-square"></i> </button>
                        
                       
                      </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
                </div>
          </div>
        </div>
                
            </div>
        </div>
    </div>
<section class="content">