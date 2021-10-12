 <div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> {{$Role->name}}</h3>

                <div class="card-tools d-flex align-items-center ">
                {{-- <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="showuser({{$Role->id}})"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a> --}}
                  <div class="input-group input-group-md" style="width: 250px;">
                    {{-- <input type="text" name="table_search" wire:model.debounce="searchUser"  class="form-control float-right" placeholder="Search"> --}}
 <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="showuser({{$Role->id}})"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a>
                    {{-- <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div> --}}
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
                      <th style="width:20%;" >E-mail</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($Users as $user)
                    <tr>
                      <td>
                       @if($user['sexe'] == "0")
                            <img src="{{asset('images/woman.png')}}" width="24"/>
                        @else
                            <img src="{{asset('images/man.png')}}" width="24"/>
                        @endif
                        </td>
                      <td>{{$user['name']}}</td>
                      <td> {{$user['email']}} </td>
                      <td><span class="tag tag-success">{{$user['created_at'] }}</span></td>
                    
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer  ">
                <div class="float-right">
                 
                    <button type="button" class="btn btn-danger" wire:click="goToListProfil()">Retour</button>
               
                    {{-- {{ $Users->links() }} --}}
                </div>
              </div>

            </div>
            <!-- /.card -->
          </div>
        </div>