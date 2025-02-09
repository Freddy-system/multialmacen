<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <!-- <h1 class="mb-0 font-size-18">Gestión de Clubes</h1> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Éxito",
                            text: "<?php echo $_SESSION['success_message']; ?>",
                            timer: 1000,
                            showConfirmButton: true
                        });
                    </script>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])) : ?>
                    <script>
                        toastr.error("<?php echo $_SESSION['error_message']; ?>" );
                    </script>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_messagea'])) : ?>
                    <script>
                        new Noty({
                            type: "success",
                            text: "<?php echo $_SESSION['success_messagea']; ?>",
                            timeout: 1000
                        }).show();
                    </script>
                    <?php unset($_SESSION['success_messagea']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_messagea1'])) : ?>
                    <script>
                        new Noty({
                            type: "error",
                            text: "<?php echo $_SESSION['success_messagea1']; ?>",
                            timeout: 1000 
                        }).show();
                    </script>
                    <?php unset($_SESSION['success_messagea1']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['eliminado'])) : ?>
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Eliminado",
                            text: "<?php echo $_SESSION['eliminado']; ?>",
                            timer: 1000,
                            showConfirmButton: true
                        });
                    </script>
                    <?php unset($_SESSION['eliminado']); ?>
                <?php endif; ?>
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0 text-white">Lista de registro de Jugadores</h5>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                <i class="ri-add-line align-bottom me-1"></i> Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="customerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Nombres y apellidos</th>
                                        <th>Nº licencia</th>
                                        <th>F. nacimiento</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos del club -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="EditarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-5">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Actualizar registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="post" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Apellido 1</label>
                    <input class="form-control" name="apellido1" id="apellido1" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Apellido 2</label>
                    <input class="form-control" name="apellido2" id="apellido2" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Nombre</label>
                    <input class="form-control" name="nombre" id="nombre" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento" placeholder="Seleccione el año">
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Nº licencia</label>
                    <input class="form-control" name="numlicencia" id="numlicencia" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-10"> 
                    <label class="form-label" for="first-name"> Teléfono</label>
                    <input class="form-control" id="telefono" name="telefono" type="text" aria-label="First name">
                  </div>
                  <div class="col-md-2"> 
                    <label class="form-label" for="exampleFormControlTextarea1">Estado</label>
                    <input type="checkbox" name="estado" class="form-check-input" id="estado">
                  </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
            <input class="form-control" type="hidden" name="actions" value="11">
            <input class="form-control" type="hidden" name="id" id="ids">
            <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-light me-2">Guardar Cambio</button>
          </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="eliminarmodal" tabindex="-1" aria-labelledby="modalEliminarTitulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center"> 
        <img src="storage/per/danger.gif" width="20%" alt="Advertencia" class="img-fluid mb-3">
        <h4 class="pb-2">Eliminar</h4>
        <p>¿Estás seguro de eliminar este registro?</p>
        <form class="needs-validation" novalidate method="post" action="index.php?action=registro">
          <input type="hidden" name="actions" value="12">
          <input type="hidden" name="id" id="id">
          <div class="modal-footer justify-content-center">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" type="submit">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Registro -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-5">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Apellido 1</label>
                    <input class="form-control" name="apellido1" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Apellido 2</label>
                    <input class="form-control" name="apellido2" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Nombre</label>
                    <input class="form-control" name="nombre" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="nacimiento" id="datePicker" placeholder="Seleccione el año">
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Nº licencia</label>
                    <input class="form-control" name="numlicencia" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Teléfono</label>
                    <input class="form-control" name="telefono" id="validationCustom01" type="text" aria-label="First name">
                  </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
              <input class="form-control" type="hidden" name="actions" value="10">
              <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light">Guardar registro</button>
            </div>
        </form>
        
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "index.php?action=apijugador",
            "columns": [
                { "data": function(row) {
                        return row.nombre + ', ' + row.apellido1 + ' '+ row.apellido2 ;
                    }
                },
                { "data": "numlicencia" },
                { "data": "nacimiento" },
                { "data": "telefono" },
                { "data": "estado",
                    "render": function(data, type, row) {
                        if(data == 1) {
                            return '<i class="ri ri-checkbox-circle-line text-success"></i>';
                        } else {
                            return '<i class="ri  ri-close-circle-line text-danger"></i>';
                        }
                    }
                },
                { 
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '">Editar</button>' + ' ' 
                        + '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Eliminar</button>';
                    }
                }
            ],
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        $('#exampleModalLong').on('show.bs.modal', function() {
          $('#select-facultad').empty();
          $.ajax({
              url: 'index.php?action=apiclubs',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  data.forEach(function(facultad) {
                      $('#select-facultad').append($('<option>', {
                          value: facultad.id,
                          text: facultad.nombre
                      }));
                  });
              },
              error: function() {
                  console.error("Error al cargar datos de la API");
              }
          });
      });
        $('#customerTable').on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $.get("index.php?action=getjugador&id=" + id, function(data) {
                $('#apellido1').val(data.apellido1);
                $('#apellido2').val(data.apellido2);
                $('#nombre').val(data.nombre);
                $('#nacimiento').val(data.nacimiento);
                $('#numlicencia').val(data.numlicencia);
                $('#telefono').val(data.telefono);
                $('#ids').val(data.id);
                if(data.estado == 1) {
                    $('#estado').prop('checked', true);
                } else {
                    $('#estado').prop('checked', false);
                }
                $.ajax({
                    url: 'index.php?action=apiclubs',
                    method: 'GET',
                    dataType: 'json',
                    success: function(facultades) {
                        $('#clud').empty();
                        $('#clud').append($('<option>', {value: '', text: 'Eligir'}));
                        facultades.forEach(function(clud) {
                            $('#clud').append($('<option>', {
                                value: clud.id,
                                text: clud.nombre
                            }));
                        });
                        $('#clud').val(data.clud);
                    }
                });
                $.ajax({
                    url: 'index.php?action=apimodulo',
                    method: 'GET',
                    dataType: 'json',
                    success: function(apimodulos) {
                        $('#apimodulo').empty();
                        $('#apimodulo').append($('<option>', {value: '', text: 'Eligir'}));
                        apimodulos.forEach(function(apimodulo) {
                            $('#apimodulo').append($('<option>', {
                                value: apimodulo.id,
                                text: apimodulo.nombre
                            }));
                        });
                        $('#apimodulo').val(data.modelocalidad);
                    }
                });
                $('#EditarModal').modal('show');
            }, "json");
        });
        $('#customerTable').on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            $('#id').val(id);
            $('#confirm-delete-btn').data('id', id);
            $('#eliminarmodal').modal('show');
        });
    });
</script>
<script>
    flatpickr("#datePicker", {
        plugins: [
            new flatpickr.plugins.monthSelect({shorthand: true, dateFormat: "m.y", altFormat: "F Y", theme: "light"}), // or "dark"
            new flatpickr.plugins.yearSelect({shorthand: true, dateFormat: "Y", altFormat: "Y", theme: "light"}) // or "dark"
        ],
        enableTime: false,
        dateFormat: "Y",
        defaultDate: new Date(),
        onChange: function(selectedDates, dateStr, instance) {
            // Puedes manejar cambios adicionales aquí si es necesario
        }
    });
</script>