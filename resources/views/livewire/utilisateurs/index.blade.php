
<div wire:ignore.self>

@if($currentPage==CREATEFORMPAGE)
@include("livewire.utilisateurs.create")
@endif
@if ($currentPage==LISTPAGE)
  @include("livewire.utilisateurs.list")
 @endif
@if ($currentPage==EDITFORMPAGE)

@include("livewire.utilisateurs.edite")
  
@endif
@if ($currentPage==RESETPAGE)
    @include("livewire.utilisateurs.reset")
            
@endif
</div>
<script>
window.addEventListener("showConfirm",event=>{
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
     @this.resetPassword() 
  }
  
})
})

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
     @this.deleteUser(event.detail.message.data.user_id)
  }

})
})
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

</script>

 
