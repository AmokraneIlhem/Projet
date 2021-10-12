<div wire:ignore.self>

@if($currentPage==CREATEFORMPAGE)
@include("livewire.employe.createFacture")
@endif
@if ($currentPage==LISTPAGE)
  @include("livewire.employe.ListeFacture")
@endif
<script>
 wire:window.addEventListener("showSuccessMessage",event=>{
    Swal.fire(
        { position: 'top-end', 
          icon: 'success',
          toast: true, 
          title: event.detail.message ||"Opération effectuée avec succès!",
          showConfirmButton : false, 
          timer: 2000 })

        }
    )
  
    window.addEventListener("showEditForm",function(e){
        Swal.fire({
            title: "Editer la Facture",
            input: 'text',
            inputValue: e.detail.facture.etat,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:'Modifier <i class="fa fa-check"></i>',
            cancelButtonText:'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire'
                }
                @this.updateFacture(e.detail.facture.id, value)
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
     @this.deleteFacture(event.detail.message.data.facture_id)
  }

})
})

</script>