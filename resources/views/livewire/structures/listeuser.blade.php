 <div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-sitemap"></i> Structure : {{$struct->libelle}}</h3>

                <div class="card-tools d-flex align-items-center ">
          
                  <div class="input-group input-group-md" style="width: 250px;">
     <a class="btn btn-link text-white mr-4 d-block"wire:click.prevent=" showuser({{$struct->id}})" ><i class="fa fa-plus"></i> Ajouter un Utilisateur </a>
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
                       <th style="width:20%;">E-mail</th>
                      <th style="width:20%;" >Roles</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                    
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
                      <td>{{$user->email}}</td>
                      <td>{{$user->role->name}}</td>
                      <td><span class="tag tag-success">{{optional( $user->created_at)->diffForHumans() }}</span></td>
                    
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="button" class="btn btn-danger" wire:click="goToListStruct()">Retour</button>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>