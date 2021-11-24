
var herramienta_id;
$(document).on('click','.delete', function(){
    herramienta_id = $(this).attr('id');
    $('#btnEliminar').text('Eliminar'); 
    $('#confirmModal').modal('show');
}); 

//el boton con id=btnEliminar está en el modal
$('#btnEliminar').click(function(){
  $(this).prop('disabled', true);
	setTimeout(()=>{$(this).prop('disabled', false)}, 1000);

  if($("#motivoTxt2").val() == ''){
    $('#motivoTxt2').effect("shake");
    toastr.warning('Indica un motivo por favor', 'Motivo faltante');
    return false;
  }

var motivo = $("#motivoTxt2").val();

if(motivo != '' && herramienta_id != ''){
  $.ajax({
    url: "/catalogo/eliminar",
    type: "POST",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:{
        id: herramienta_id, motivo: motivo
    },
    beforeSend: function(){
      $('#btnEliminar').text('Eliminando....');
    },
    success:function(response){

      if(response.success == false){
        let message = `Tienes ${response.cantidad} articulos de este tipo en prestamos pendientes
                      <br><a href="#">IR A INVENTARIO</a>`; 
        toastr.warning(message, 'Prestamos sin regresar', {timeOut:3000});
      }
      // setTimeout(function(){
      //   $('#confirmModal').modal('hide');
      //   $("#motivoTxt2").val($('#motivoTxt2').prop("defaultValue"));
      //   toastr.warning('El registro fue eliminado correctamente.', 'Eliminar registro', {timeOut:3000});
      //   $('#tabla-catalogo').DataTable().ajax.reload(null,false);
      // },500);
    }
  });
}

// $.ajax({
//   url: "catalogo/eliminar/"+herramienta_id,
//   beforeSend: function(){
//     $('#btnEliminar').text('Eliminando....');
//   },
//   success: function(data){
//     setTimeout(function(){
//       $('#confirmModal').modal('hide');
//       toastr.warning('El registro fue eliminado correctamente.', 'Eliminar registro', {timeOut:3000});
//       $('#tabla-catalogo').DataTable().ajax.reload(null,false);
//     },2000);
//     //$('#btnEliminar').text('Eliminar'); 
//   }
// });





});