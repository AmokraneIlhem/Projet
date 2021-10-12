 
<div wire:ignore.self>
@if ($currentPage==LISTPAGE)
@include("livewire.structures.liste")
@endif
@if($currentPage==CREATEFORMPAGE)
@include("livewire.structures.create")
@endif
@if ($currentPage==EDITFORMPAGE)
  @include("livewire.structures.edit")
@endif
@if ($currentPage==USERPAGE)
@include("livewire.structures.adduser")
  @include("livewire.structures.listeuser")
@endif
@if ($currentPage==FACTUREPAGE)
  @include("livewire.structures.listefacture")
@endif

<script>
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
     @this.deleteStruct(event.detail.message.data.structure_id)
  }
})})
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
  </div>