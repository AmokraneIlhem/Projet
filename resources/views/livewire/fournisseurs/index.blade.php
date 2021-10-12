<div wire:ignore.self>
@if ($currentPage==LISTPAGE)
@include("livewire.fournisseurs.liste")
@endif
@if($currentPage==CREATEFORMPAGE)
@include("livewire.fournisseurs.create")
@endif
@if ($currentPage==EDITFORMPAGE)

@include("livewire.fournisseurs.edit")
  
@endif
@if ($currentPage==FACTUREPAGE)
  @include("livewire.fournisseurs.listefacture")
@endif
 </div>
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
     @this.deleteFournisseur(event.detail.message.data.fournisseur_id)
  }

})
})
</script>