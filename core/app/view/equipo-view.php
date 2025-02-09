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
                            <h5 class="card-title mb-0 text-white">Lista de registro de Equipos</h5>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                <i class="ri-add-line align-bottom me-1"></i> Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="customerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Equipo</th>
                                        <th>Capitán</th>
                                        <th>Subcapitán</th>
                                        <th>Club</th>
                                        <th>Categoria</th>
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
                <div class="col-md-10"> 
                    <label class="form-label" for="first-name"> Club</label>
                    <select class="form-control" name="club" id="select-clubb"><option></option></select>
                  </div>
                  <div class="col-md-2">
                    <label class="form-check-label" for="estado">Estado</label>
                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                        <input type="checkbox" name="estado" class="form-check-input" id="estado">
                    </div>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Nombre</label>
                    <input class="form-control" name="nombre" id="nombre" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Categoria</label>
                    <input class="form-control" name="categoria" id="categoria" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Capitan</label>
                    <select name="capitan" required class="form-control select-usuario1">
                        <option value="">Eligir</option>
                    </select>
                  </div>
                  <div class="col-md-6"> 
                    <label class="form-label" for="first-name"> Subcapitan</label>
                    <select name="subcapitan" class="form-control select-usuario2">
                        <option value="">Eligir</option>
                    </select>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="exampleFormControlTextarea1"> Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                  </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
            <input class="form-control" type="hidden" name="actions" value="14">
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
          <input type="hidden" name="actions" value="15">
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
                <div class="col-md-12"> 
                <label class="form-label" for="first-name"> Club</label>
                <select class="form-control" name="club" id="select-club"><option></option></select>
              </div>
              <div class="col-md-12"> 
                <label class="form-label" for="first-name"> Nombre</label>
                <input class="form-control" name="nombre" type="text" aria-label="First name" required>
              </div>
              <div class="col-md-12"> 
                <label class="form-label" for="first-name"> Categoria</label>
                <input class="form-control" name="categoria" id="validationCustom01" type="text" aria-label="First name" required>
              </div>
              <div class="col-md-6"> 
                <label class="form-label" for="first-name"> Capitan</label>
                <select name="capitan" required class="form-control select-usuario">
                    <option value="">Eligir</option>
                </select>
              </div>
              <div class="col-md-6"> 
                <label class="form-label" for="first-name"> Subcapitan</label>
                <select name="subcapitan" class="form-control select-usuario">
                    <option value="">Eligir</option>
                </select>
              </div>
              <div class="col-md-12"> 
                <label class="form-label" for="exampleFormControlTextarea1"> Descripción</label>
                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
              <input class="form-control" type="hidden" name="actions" value="13">
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
            "ajax": "index.php?action=apiequipo",
            "columns": [
                { "data": function(row) {
                        return row.nombre ;
                    }
                },
                { "data": "capitanes" },
                { "data": "subcapitanes" },
                { "data": "clubes" },
                { "data": "categoria" },
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
          $('#select-club').empty();
          $.ajax({
              url: 'index.php?action=apiclubs',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  data.forEach(function(clubes) {
                      $('#select-club').append($('<option>', {
                          value: clubes.id,
                          text: clubes.nombre
                      }));
                  });
              },
              error: function() {
                  console.error("Error al cargar datos de la API");
              }
          });
          $.ajax({
              url: 'index.php?action=apiusuario',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  data.forEach(function(usuario) {
                      $('.select-usuario').append($('<option>', {
                          value: usuario.id,
                          text: usuario.nombre + ', ' + usuario.apellido
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
            $.get("index.php?action=getequipo&id=" + id, function(data) {
                $('#categoria').val(data.categoria);
                $('#nombre').val(data.nombre);
                $('#descripcion').val(data.descripcion);
                $('#ids').val(data.id);
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
                        // $('#select-clubb').empty();
                        // $('#select-clubb').append($('<option>', {value: '', text: 'Eligir'}));
                        facultades.forEach(function(club) {
                            $('#select-clubb').append($('<option>', {
                                value: club.id,
                                text: club.nombre
                            }));
                        });
                        $('#select-clubb').val(data.club);
                    }
                });
                $.ajax({
                    url: 'index.php?action=apiusuario',
                    method: 'GET',
                    dataType: 'json',
                    success: function(apimodulos) {
                        $('.select-usuario1').empty();
                        $('.select-usuario1').append($('<option>', {value: '', text: 'Eligir'}));
                        apimodulos.forEach(function(capitan) {
                            $('.select-usuario1').append($('<option>', {
                                value: capitan.id,
                                text: capitan.nombre + ', ' + capitan.apellido
                            }));
                        });
                        $('.select-usuario1').val(data.capitan);
                    }
                });
                $.ajax({
                    url: 'index.php?action=apiusuario',
                    method: 'GET',
                    dataType: 'json',
                    success: function(apimodulos) {
                        $('.select-usuario2').empty();
                        $('.select-usuario2').append($('<option>', {value: '', text: 'Eligir'}));
                        apimodulos.forEach(function(subcapitan) {
                            $('.select-usuario2').append($('<option>', {
                                value: subcapitan.id,
                                text: subcapitan.nombre + ', ' + subcapitan.apellido
                            }));
                        });
                        $('.select-usuario2').val(data.subcapitan);
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