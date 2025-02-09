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
                            <h5 class="card-title mb-0 text-white">Lista de registro de Articulos</h5>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="ri-add-line align-bottom me-1"></i> Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="customerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Articulo</th>
                                        <th>Categoria</th>
                                        <th>Código</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Serie</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Actualizar registro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                  <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
                    <div class="modal-body bg-light">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nombre" class="form-label">nombre del Articulo / Producto / Material <b style="color: #FF0000;">*</b></label>
                                        <input type="text" required name="nombre" class="form-control" id="nombre">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="categoria" class="form-label">Categoria <b style="color: #FF0000;">*</b></label>
                                        <select  name="categoria" id="categoria" required class="form-select rounded-pill">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Marca</label>
                                        <input type="text" name="marca" class="form-control" id="marca">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Serie</label>
                                        <input type="text" name="serie" class="form-control" id="serie">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Modelo</label>
                                        <input type="text" name="modelo" class="form-control" id="modelo">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Color</label>
                                        <input type="text" name="color" class="form-control" id="color">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Estado</label>
                                        <input type="text" name="estado" class="form-control" id="estado">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">F. Vencimiento</label>
                                        <input type="date" name="vencimiento" class="form-control" id="vencimiento">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Talla</label>
                                        <input type="text" name="talla" class="form-control" id="talla">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label">Par</label>
                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                            <input type="checkbox" name="par" id="par" class="form-check-input form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="imagen" class="form-label">Imagen</label>
                                        <input type="file" name="imagen" class="form-control">
                                        <input class="form-control" id="imagen1Campo" name="imagen1" type="hidden" aria-label="First name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" required name="codigo" class="form-control" id="codigo">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="basiInput" class="form-label">Descripción</label>
                                        <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-2" href="URL_DE_LA_IMAGEN" target="_blank">
                                <img id="imagen1" alt="">
                                <style>
                                    #imagen1 {
                                        width: 100%; /* Ancho al 100% del contenedor */
                                        height: auto; /* Altura automática para mantener la proporción */
                                        border: 2px solid #ccc;
                                        border-radius: 10px;
                                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                                        display: block;
                                        margin: 0 auto;
                                    }
                                </style>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer bg-info d-flex justify-content-between pb-0">
                        <input class="form-control" type="hidden" name="actions" value="17">
                        <input class="form-control" type="hidden" name="id" id="ids">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-light me-2">Guardar Cambio</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal de Registro -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-8">
                    <label for="basiInput" class="form-label">nombre del Articulo / Producto / Material <b style="color: #FF0000;">*</b></label>
                    <input type="text" required name="nombre" class="form-control" id="basiInput">
                </div>
                <div class="col-md-4">
                    <label for="basiInput" class="form-label">Categoria <b style="color: #FF0000;">*</b></label>
                    <select  name="categoria" required class="form-select rounded-pill">
                        <option selected value="">Seleccionar</option>
                    <?php $cartegoriasdata = CategoriaData::vercontenido();
                    foreach ($cartegoriasdata as $category) { ?>
                        <option  value="<?= $category->id;?>"><?= $category->nombre;?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Serie</label>
                    <input type="text" name="serie" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Modelo</label>
                    <input type="text" name="modelo" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Color</label>
                    <input type="text" name="color" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Estado</label>
                    <input type="text" name="estado" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">F. Vencimiento</label>
                    <input type="date" name="vencimiento" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Talla</label>
                    <input type="text" name="talla" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Par</label>
                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                        <input type="checkbox" name="par" class="form-check-input form-control">
                    </div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <label for="basiInput" class="form-label">Imagen</label>
                    <input type="file" name="imagen" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                    <label for="basiInput" class="form-label">Código</label>
                    <input type="text" required name="codigo" class="form-control" id="basiInput">
                </div>
                <div class="col-md-12">
                    <label for="basiInput" class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion"></textarea>
                </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
              <input class="form-control" type="hidden" name="actions" value="16">
              <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light">Guardar registro</button>
            </div>
        </form>
        
    </div>
  </div>
</div>
<!-- Asignar Precio y Unidad -->
<div class="modal fade" id="Modalprecio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Asignar Unidad / Precio</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-1">
                            <form class="tablelist-form" autocomplete="off" method="post" enctype="multipart/form-data" action="index.php?action=registro">
                                <div class="row gy-1">
                                    <div class="col-xxl-4 col-md-4">
                                        <div>
                                            <label for="basiInput" class="form-label">Tipo de Precio</label>
                                            <select required name="tipo" class="form-control">
                                                <option value="Menor">Menor</option>
                                                <option value="Mayor">Mayor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-8 col-md-8">
                                        <div>
                                            <label for="basiInput" class="form-label">Unidad de Presentación</label>
                                            <select required name="unidad" id="presentaciones" class="form-control">
                                                <option value="">Seleccionar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <label for="basiInput" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" name="cantidad">
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-md-1">
                                        <label class="form-check-label" for="customSwitchsizelg">Nuevo</label>
                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                            <input type="checkbox" id="customSwitchsizelg" name="estado" class="form-check-input form-control">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Precio Compra MXN</label>
                                            <div class="ver1">
                                                <select class="form-control" id="precios" name="precioc1">
                                                  <option value="">Seleccionar</option>  
                                                </select>
                                            </div>
                                            <div class="ver2" style="display: none;">
                                                <input type="number" class="form-control" name="precioc2">
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            // Manejar el evento de cambio en el checkbox
                                            $('#customSwitchsizelg').change(function() {
                                                // Si el checkbox está marcado
                                                if ($(this).is(':checked')) {
                                                    // Ocultar la opción Ver 1 y mostrar la opción Ver 2
                                                    $('.ver1').hide();
                                                    $('.ver2').show();
                                                } else {
                                                    // Si el checkbox está desmarcado, mostrar la opción Ver 1 y ocultar la opción Ver 2
                                                    $('.ver1').show();
                                                    $('.ver2').hide();
                                                }
                                            });
                                        });
                                    </script>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Precio Venta MXN</label>
                                            <input type="number" class="form-control" name="precio">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Comisión MXN</label>
                                            <input type="number" class="form-control" name="comision">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <input type="hidden" name="actions" value="31">
                                            <input type="hidden" name="articulo" id="articulo">
                                            <button type="submit" class="btn btn-success" id="add-btn">Registrar Precio</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <style>
                                #fullcargos {
                                    font-size: 9px;
                                }
                                #javi{
                                    font-size: 10px;
                                }
                            </style>
                            <table id="fullcargos" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Pres.</th>
                                        <th>Cantidad</th>
                                        <!-- <th>Moneda</th> -->
                                        <th>Precio C.</th>
                                        <th>Precio V.</th>
                                        <th>Comisión</th>
                                        <th width="1px"><i class="ri-checkbox-line"></i></th>
                                        <th width="1px"><i class="ri-delete-bin-2-line"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
<script>
$(document).ready(function() {
    var table;
    $('#Modalprecio').on('shown.bs.modal', function (e) {
        let id = $("#articulo").val();
        if ($('#presentaciones option').length <= 1) {
                $.ajax({
                    url: 'index.php?action=apipresentaciones',
                    method: 'GET',
                    dataType: 'json',
                    success: function(pres) {
                        pres.forEach(function(presentaciones1) {
                            $('#presentaciones').append($('<option>', {
                                value: presentaciones1.id,
                                text: presentaciones1.nombre
                            }));
                        });
                    }
                });
            }
        if ($('#precios option').length <= 1) {
                $.ajax({
                    url: 'index.php?action=apiprecioscompra&articulo=' + id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(pres) {
                        pres.forEach(function(preciocompras) {
                            $('#precios').append($('<option>', {
                                value: preciocompras.precio,
                                text: preciocompras.precio
                            }));
                        });
                    }
                });
            }

        if (table) { 
            table.ajax.url("index.php?action=apiprecio&articulo=" + id).load();
        } else {
            table = $('#fullcargos').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "index.php?action=apiprecio&articulo=" + id,
                "columns": [
                    {
                        "data": "tipo",
                        "render": function(data, type, row) {
                            let selectedMenor = (data == "Menor") ? 'selected' : '';
                            let selectedMayor = (data == "Mayor") ? 'selected' : '';

                            return '<select id="javi" class="form-control" name="tipo_' + row.id + '">' +
                                        '<option value="Menor" ' + selectedMenor + '>Menor</option>' +
                                        '<option value="Mayor" ' + selectedMayor + '>Mayor</option>' +
                                   '</select>';
                        }
                    },
                    { "data": "unidad",
                        "render": function(data, type, row) {
                            var selectHTML = '<select id="javi" class="form-control" name="presentacion_' + row.id + '" id="presentacion_' + row.id + '">';

                            $.ajax({
                                url: 'index.php?action=apipresentaciones',
                                method: 'GET',
                                dataType: 'json',
                                async: false,
                                success: function(pres) {
                                    pres.forEach(function(presentacion2) {
                                        let isSelected = (data == presentacion2.id) ? 'selected' : '';
                                        selectHTML += '<option value="' + presentacion2.id + '" ' + isSelected + '>' + presentacion2.nombre + '</option>';
                                    });
                                }
                            });

                            selectHTML += '</select>';
                            return selectHTML;
                        }
                    },
                    { 
                        "data": "cantidad",
                        "render": function(data, type, row) {
                            return '<input type="number" id="javi" class="form-control" name="cantidad_' + row.id + '" value="' + data + '">';
                        }
                    },
                    // { "data": "moneda" },
                    {
                        "data": "precioc",
                    },
                    {
                        "data": "precio",
                        "render": function(data, type, row) {
                            return '<input type="number" id="javi" class="form-control" name="precio_' + row.id + '" value="' + data + '">';
                        }
                    },
                    { 
                        "data": "comision",
                        "render": function(data, type, row) {
                            return '<input type="number" id="javi" class="form-control" name="comision_' + row.id + '" value="' + data + '">';
                        }
                    },
                    { 
                        "data": "estado",
                        "render": function(data, type, row) {
                            let isChecked = (data == 1) ? 'checked' : '';
                            return '<input type="checkbox" name="estado_' + row.id + '" class="form-check-input" id="estado_' + row.id + '" ' + isChecked + '>';
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-danger btn-sm delete1-btn" data-id="' + row.id + '"><i class="ri-delete-bin-2-line"></i></button>';
                        }
                    }
                ],
                
                    "language": {
                        "sProcessing": "Procesando...",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    "bFilter": false,
                    "bLengthChange": false
                
            });
            $('#fullcargos').on('input change', 'input, select', function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "50",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                let columnName = $(this).attr('name').split('_')[0]; 
                let rowId = $(this).attr('name').split('_')[1];
                let value = $(this).is(':checkbox') ? ($(this).is(':checked') ? 1 : 0) : $(this).val();
                $.ajax({
                    url: 'index.php?action=updateprecio',
                    type: 'POST',
                    data: {
                        column: columnName,
                        id: rowId,
                        value: value
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // toastr.success('Ha sido actualizado correctamente');
                            table.ajax.reload();
                        } else {
                            // toastr.error('Hubo un error al actualizar');
                            toastr.success('Ha sido actualizado correctamente');
                            // table.ajax.reload();
                        }
                    },
                    error: function(err) {
                        console.error("Error al actualizar:", err);
                        toastr.error('Error al intentar comunicarse con el servidor.');
                    }
                });
            });
        }
    });
    $('#Modalprecio').on('hidden.bs.modal', function (e) {
        if (table) {
            table.destroy();
            table = null;
        }
    });
    $('#fullcargos').on('click', '.delete1-btn', function() {
        let rowId = $(this).data('id');
        if (confirm('¿Está seguro de que desea eliminar este registro?')) {
            $.ajax({
                url: 'index.php?action=deleteprecio',
                type: 'POST',
                data: {
                    id: rowId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success('Registro eliminado correctamente');
                        table.ajax.reload(); // Refrescar la tabla después de eliminar el registro
                    } else {
                        // toastr.error('Hubo un error al eliminar');
                        toastr.success('Registro eliminado correctamente, Refrescar la tabla después de eliminar el registro');
                        table.ajax.reload();
                    }
                },
                error: function(err) {
                    console.error("Error al eliminar:", err);
                    toastr.error('Error al intentar comunicarse con el servidor.');
                }
            });
        }
    });
});
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": "index.php?action=apiproducto",
            "columns": [
                { "data": "nombre" },
                { "data": "categorias" },
                { "data": "codigo" },
                { "data": "marca" },
                { "data": "modelo" },
                { "data": "serie" },
                { 
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-primary btn-sm precio-btn" data-id="' + row.id + '"><i class="ri-money-dollar-circle-line fs-100"></i></button>' + ' '
                        + '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '"><i class="ri-edit-2-fill align-bottom me-1"></i></button>' + ' ' 
                        + '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '"><i class="ri-delete-bin-2-line align-bottom me-1"></button>';
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
        $('#customerTable').on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $.get("index.php?action=getproducto&id=" + id, function(data) {
                $('#nombre').val(data.nombre);
                $('#preciocompra').val(data.preciocompra);
                $('#marca').val(data.marca);
                $('#serie').val(data.serie);
                $('#modelo').val(data.modelo);
                $('#codigo').val(data.codigo);

                $('#color').val(data.color);
                $('#estado').val(data.estado);
                $('#vencimiento').val(data.vencimiento);
                $('#talla').val(data.talla);
                $('#descripcion').val(data.descripcion);
                if(data.par == 1) {
                    $('#par').prop('checked', true);
                } else {
                    $('#par').prop('checked', false);
                }
                if (data.imagen) {
                    var imagenURL = 'storage/archivo/' + data.imagen;
                    $('#imagen1').attr('src', imagenURL);
                    $('#imagen1Campo').val(data.imagen);
                } else {
                    $('#imagen1').attr('src', 'storage/per/logo.png');
                    $('#imagen1Campo').val(''); 
                }
                $.ajax({
                    url: 'index.php?action=apicategorias',
                    method: 'GET',
                    dataType: 'json',
                    success: function(datos) {
                        $('#categoria').empty();
                        $('#categoria').append($('<option>', {value: '', text: 'Eligir'}));
                        datos.forEach(function(categoria) {
                            $('#categoria').append($('<option>', {
                                value: categoria.id,
                                text: categoria.nombre
                            }));
                        });
                        $('#categoria').val(data.categoria);
                    }
                });
                $('#ids').val(data.id);
                $('#editModal').modal('show');
            }, "json");
        });
        $('#customerTable').on('click', '.precio-btn', function() {
            let id = $(this).data('id');
            $.get("index.php?action=getproducto&id=" + id, function(data) {
                $('#nombre1').val(data.nombre);
                $('#articulo').val(data.id);
                $('#Modalprecio').modal('show');
            }, "json");
        });
    });
</script>