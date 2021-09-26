<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Almacen UTLD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('catalogo.index')}}">Inventario <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('catalogo.index')}}">Catalogo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Movimientos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Gestionar movimientos</a> 
        <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Entradas</a>
          <a class="dropdown-item" href="#">Salidas</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" 
                aria-controls="home" aria-selected="true">Catalogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" 
                aria-controls="profile" aria-selected="false">Agregar herramienta</a>
            </li>
        </ul>
  <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <table id="tabla-catalogo" class="cell-border hover">
                <thead>
                  <td>id</td>
                  <td>descripcion</td>
                  <td>codigo</td>
                  <td>serie</td>
                  <td>categoria</td>
                  <td>Acciones</td>
                </thead>

              </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <h3>Agregar nueva herramienta</h3>
              <form id="registro-herramienta">
                @csrf
                <div class="form-group">
                    <label for="txtDescripcion">Descripcion</label>
                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="1" required></textarea>
                </div>
                <div class="form-group">
                  <label for="txtCodigo">Codigo</label> 
                  <input type="number" class="form-control" id="txtCodigo" name="txtCodigo">
                </div>
                <div class="form-group">
                  <label for="txtSerie">Serie</label> 
                  <input type="number" class="form-control" id="txtSerie" name="txtSerie">
                </div>
                <div class="form-group">
                <select class="form-control form-select-lg" aria-label="Default select example" id="selCategoria" name="selCategoria" required>
                  <option disabled selected value> -- Selecciona un tipo de herramienta --- </option>
                  @foreach($tipos as $tipo)  
                  <option value={{$tipo->id}}>{{$tipo->tipo}}</option>
                  @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrar herramienta</button>
            </form>
            </div>

                  <!-- Modal eliminar -->
            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ¿Desea eliminar el registro seleccionado?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-primary">Eliminar</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal EDITAR -->
<div class="modal fade" id="herramienta_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Animal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="herramienta_edit_form">
        <div class="modal-body">
                  @csrf
                  <input type="hidden" id="txtId2" name="txtId2">
                  <div class="form-group">
                    <label for="txtDescripcion2">Descripcion</label>
                    <textarea class="form-control" id="txtDescripcion2" name="txtDescripcion2" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="txtCodigo2">Codigo</label> 
                  <input type="number" class="form-control" id="txtCodigo2" name="txtCodigo2" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="txtSerie2">Serie</label> 
                  <input type="number" class="form-control" id="txtSerie2" name="txtSerie2" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                <select class="form-control form-select-lg" aria-label="Default select example" id="selCategoria2" name="selCategoria2">
                    <option selected>categoria</option>
                    <option value="1">Pinzas</option>
                    <option value="2">Martillos</option>
                  </select>
                </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form> <!--form modal editar-->
    </div>
  </div>
</div>

        </div><!--fin container-->
        

            <script>
                $(document).ready(function(){
                    var tablaCatalogo = $('#tabla-catalogo').DataTable({
                    processing:true,
                    serverSide:true,
                    ajax:{
                        url: "{{route('catalogo.index')}}",
                    },
                    columns:[
                        {data: 'id'},
                        {data: 'descripcion'},
                        {data: 'codigo'},
                        {data: 'numserie'},
                        {data: 'tipo'},
                        {data: 'action', orderable:false}
                    ]
                    });
                });
            </script>
            <script>
                  $('#registro-herramienta').submit(function(e){
                      e.preventDefault(); 
                      var descripcion = $('#txtDescripcion').val();
                      var codigo = $('#txtCodigo').val();
                      var serie = $('#txtSerie').val();
                      var tipo = $('#selCategoria').val();
                      var _token = $("input[name=_token]").val();
                      
                      console.log(descripcion,tipo);

                      $.ajax({
                          url: "{{route('catalogo.registrar')}}",
                          type: "POST",
                          data:{
                              descripcion: descripcion,
                              codigo: codigo,
                              numserie: serie,
                              tipo: tipo,
                              _token:_token
                          },
                          success:function(response){
                            if(response){
                              $('#registro-herramienta')[0].reset(); //si se realiza el post correctamente,borrame la caja de registro
                              toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut: 3000});
                              $('#tabla-catalogo').DataTable().ajax.reload(); //cuando ingrese datos, que se actualice la tabla
                            }
                          }

                        });
                    });
              </script>

            <script>
              var herramienta_id;
              $(document).on('click','.delete', function(){
                  herramienta_id = $(this).attr('id');
                  $('#btnEliminar').text('Eliminar'); 
                  $('#confirmModal').modal('show');
              }); 

              //el boton con id=btnEliminar está en el modal
            $('#btnEliminar').click(function(){
              $.ajax({
                url: "catalogo/eliminar/"+herramienta_id,
                beforeSend: function(){
                  $('#btnEliminar').text('Eliminando....');
                },
                success: function(data){
                  setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    toastr.warning('El registro fue eliminado correctamente.', 'Eliminar registro', {timeOut:3000});
                    $('#tabla-catalogo').DataTable().ajax.reload();
                  },2000);
                  //$('#btnEliminar').text('Eliminar'); 
                }
              });
            });
            </script>
            <script>
              function editarHerramienta(id){
                $.get('catalogo/editar/' + id, function(herramienta){
                  //asignar los datos asignados a la ventana modal
                  $('#txtId2').val(herramienta[0].id);
                  $('#txtDescripcion2').val(herramienta[0].descripcion);
                  $('#txtCodigo2').val(herramienta[0].codigo);
                  $('#txtSerie2').val(herramienta[0].numserie);
                  $('#selCategoria2').val(herramienta[0].tipo);
                  $("input[name=_token]").val();
                  
                  $('#herramienta_edit_modal').modal('toggle');
                });
              }
            </script>
            <script>
            $('#herramienta_edit_form').submit(function(e){
              e.preventDefault();
              var id2 = $('#txtId2').val();
              var descripcion2 = $('#txtDescripcion2').val();
              var codigo2 = $('#txtCodigo2').val();
              var serie2 = $('#txtSerie2').val();
              var tipo2 = $("#selCategoria2").val();
              var _token2 = $("input[name=_token]").val();

              $.ajax({
                url: "{{ route('catalogo.actualizar') }}",
                type: "POST",
                data:{
                  id: id2,
                  descripcion: descripcion2,
                  codigo: codigo2,
                  numserie: serie2,
                  tipo: tipo2,
                  _token:_token2
                },
                success:function(response){
                  if(response){
                    $('#herramienta_edit_modal').modal('hide');
                    toastr.info('La herramienta fue actualizada correctamente.', 'Actualizar registro', {timeOut:3000});
                    $('#tabla-catalogo').DataTable().ajax.reload();

                  }
                }
              })
              

            });

</script>
    
</body>
</html>