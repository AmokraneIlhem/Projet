<div wire:ignore.self>
@if ($curentPage==CREATEFORMPAGE)
@include("livewire.profils.adduser")
  @include("livewire.profils.liste")  

@endif
@if ($curentPage==EDITFORMPAGE)
    @include("livewire.profils.edite")
@endif
@if ($curentPage==LISTPAGE)


      <!-- Default box -->
      <div class="card ">
        
        
        </div>
        <div class="card-body p-0 ">
          <table class="table table-striped projects ">
              <thead>
             <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-user-circle fa-2x"></i> </h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddProfilForm()"><i class="fas fa-plus"></i> Nouveau Profil</a>
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" wire:model.debounce="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
           
                  <tr>
                      <th style="width: 15%">
                       
                      </th>
                      <th style="width: 30%">
                          Profil
                      </th>
                   <th style="width: 40%">
                      Action
                      </th>
                  </tr>
              </thead>
               <tbody>
               @if ($isAddProfil)
                            <tr>
                                <td colspan="3">
                                    <input type="text"
                                    wire:keydown.enter="addProfil()"
                                    class="form-control @error('newProfil') is-invalid @enderror"
                                    wire:model="newProfil" />
                                    @error('newProfil')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="addProfil()"> <i class="fa fa-check"></i> Valider</button>
                                    <button class="btn btn-link" wire:click="toggleShowAddProfilForm()"> <i class="fa fa-times"></i> Annuler</button>
                                </td>
                            </tr>
                        @endif
                @foreach ($roles as $role )
             
                  <tr>
                      <td>
                         <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                      </td>
                      <td>
                          <a>
                              {{$role->name }}
                               
                          </a>
                          <br>
                          <small>
                           
                          </small>
                      </td>
                      
                    
                      
            
                      <td class="project-actions text-right">
                          <a class="btn btn-link " wire:click="goToListUser({{$role->id}})"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Afficher les utilisateurs">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            
                          </a>
                          
                          <a class="btn btn-link" wire:click="editProfil({{$role->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editer le profil">
                             <i class="far fa-edit"></i>
                            
                          </a>
                           <a class="btn btn-link " wire:click="goToEditPer({{$role->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gerer les permissions attribuées au profil">
                             <i class="fas fa-fingerprint "></i>
                             
                          </a>
                        
                           @if(count($role->users)==0)
                          <a class="btn btn-link " wire:click="confirmDelete('{{ $role->name }} ', {{$role->id}})">
                              <i class="far fa-trash-alt">
                              </i>
                              Delete
                          </a>
                          @endif
                      </td>
                  </tr>
               
                  @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
         <div class="card-footer   ">
                <div class="float-right ">
                    {{ $roles->links() }}
                </div>
              </div>
      </div>
      <!-- /.card -->

    </section>
@endif
  
<script>
window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
window.addEventListener("showConfirmMessage",event=>{
Swal.fire({
  title: "Êtes-vous sûr de continuer?",
  text: event.detail.message.text,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Continuer',
   cancelButtonText:'Annuler'
}).then((result) => {
  if (result.isConfirmed) {
     @this.deleteProfil(event.detail.message.data.role_id)
  }

})
})

</script>
<script>
    window.addEventListener("showEditForm",function(e){
        Swal.fire({
            title: "Editer le Profil",
            input: 'text',
            inputValue: e.detail.profil.name ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:'Modifier <i class="fa fa-check"></i>',
            cancelButtonText:'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire'
                }
                @this.updateProfil(e.detail.profil.id, value)
            }
        })
    })

  window.addEventListener("showModal", event=>{
       $("#modalProp").modal({
           "show": true,
           "backdrop": "static"
       })
    })
       window.addEventListener("closeModal", event=>{
       $("#modalProp").modal("hide") 
    })
</script>