<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <!-- Espacio para un título si lo requieres -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Lista de Compras</h5>
                                    <div>
                                        <a href="compra" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Agregar</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="customerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subtotal</th>
                                                <th>Descuento</th>
                                                <th>Igv</th>
                                                <th>Total</th>
                                                <th>Recibidor</th>
                                                <th>Fecha</th>
                                                <th><i class="ri-list-settings-line"></th>
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
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title text-white" id="editModalLabel">Detalles de la Compra</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Compra Nº</h6>
                            <p id="id" class="text-muted"></p>
                            <h6>Sucursal</h6>
                            <p id="sucursales1" class="text-muted"></p>
                            <h6>Fecha</h6>
                            <p id="fecha" class="text-muted"></p>
                            <h6>Moneda</h6>
                            <p id="moneda" class="text-muted"></p>
                            <h6>Recibidor</h6>
                            <p id="recibidores" class="text-muted"></p>
                            <h6>Atendido por</h6>
                            <p id="atendedor" class="text-muted"></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Subtotal</h6>
                            <p id="subtotal" class="text-muted"></p>
                            <h6>Descuento</h6>
                            <p id="descuento" class="text-muted"></p>
                            <h6>IVA</h6>
                            <p id="iva" class="text-muted"></p>
                            <h6>Total</h6>
                            <p id="total" class="text-muted"></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Tipo de Compra</h6>
                            <p id="tipo_compras" class="text-muted"></p>
                            <h6>Adelanto</h6>
                            <p id="adelanto" class="text-muted"></p>
                            <h6>Restante</h6>
                            <p id="restante" class="text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <form class="tablelist-form" autocomplete="off" method="post" action="index.php?action=registro">
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>¿Estás seguro?</h4>
                            <p class="text-muted mx-4 mb-0">¿Está seguro de que desea eliminar este registro?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <input type="hidden" name="actions" value="24">
                        <input type="hidden" name="id" id="id">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn w-sm btn-danger " id="delete-record">¡Sí, elimínalo!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form enctype="multipart/form-data" class="tablelist-form" autocomplete="off" method="post" action="index.php?action=registro">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-0">
                                <div class="col-xxl-12 col-md-12">
                                    <label for="customername-field" class="form-label">Sucursal</label>
                                    <select class="form-control" id="sucursal-fieldd" name="sucursal">
                                    <option value="">Eligir</option>
                                    </select>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <label for="customername-field" class="form-label">Cargo</label>
                                    <input type="text" name="nombre" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <input type="hidden" name="actions" value="22">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Validar registro</button>
                    </div>
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
            "ajax": "index.php?action=apimcompra",
            "columns": [
                { "data": "id",
                    "render": function (data, type, row) {
                        return 'Nº ' + data;
                    }
                },
                { "data": "subtotal",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data);
                    }
                },
                { "data": "descuento",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data);
                    }
                },
                { "data": "igv",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data);
                    }
                },
                { "data": "total",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data);
                    }
                },
                { "data": "responsable" },
                { "data": "fecha" },
                { 
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="detallecompra?tid=' + row.id + '" class="btn btn-primary btn-sm">Detalle</a>';
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
            $.get("index.php?action=getcompra&id=" + id, function(data) {
                $('#id').text('#'+data.id);
                $('#sucursales1').text(data.sucursales);
                $('#tipo_compras').text(data.tipo_compras);

        // Formateo como moneda
                $('#subtotal').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.subtotal)));
                $('#descuento').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.descuento)));
                $('#iva').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.iva)));
                $('#total').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.total)));
                $('#adelanto').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.adelanto)));
                $('#restante').text(new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(parseFloat(data.restante)));
                // $('#restante').text(new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(parseFloat(data.restante)));
        // Otros datos
                $('#moneda').text(data.moneda);
                $('#recibidores').text(data.recibidores);
                $('#atendedor').text(data.atendedor);
                $('#fecha').text(data.fecha);
                $('#ids').val(data.id);
                $('#editModal').modal('show');
            }, "json");
        });
        $('#customerTable').on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            $('#id').val(id);
            $('#confirm-delete-btn').data('id', id);
            $('#deleteModal').modal('show');
        });
    });
</script>