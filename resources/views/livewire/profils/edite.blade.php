

 <div class="row">
  <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Permissions</h3>
                    <button class="btn bg-gradient-success" wire:click="updateRoleAndPermissions"><i class="fas fa-check"></i> Appliquer les modifications</button>
                    </div>
                    <!-- /.card-header -->
                      <div class="card-body">
                            <div id="accordion">
                                    @foreach($rolePermissions["permissions"] as $permission)
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between  ">
                                            <h4 class="card-title flex-grow-1 ">
                                            <a  data-parent="#accordion " href="#"  aria-expanded="true">
                                              <div class="text-dark">  {{ $permission["permission_nom"]}} </div>
                                            </a>
                                            </h4>
                                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">

                                                <input type="checkbox" class="custom-control-input "
                                                    @if($permission["active"]) checked @endif
                                                    wire:model.lazy="rolePermissions.permissions.{{$loop->index}}.active"
                                                    id="customSwitchPermission{{$permission['permission_id']}}">
                                                <label class="custom-control-label " for="customSwitchPermission{{$permission['permission_id']}}"> {{ $permission["active"]? "Activé" : "Desactivé" }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                    </div>
  <div class="card-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-danger" wire:click="goToListProfil()">Retour</button>
                </div>
              </div>
                  
                </div>
           </div>