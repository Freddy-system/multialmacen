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
                                    <h5 class="card-title mb-0 flex-grow-1">Lista de Compras por pagar</h5>
                                    <div>
                                        <a href="compra" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Agregar</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="customerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Articulo</th>
                                                <th>Cantidad</th>
                                                <th>Abono</th>
                                                <th>Costo Total</th>
                                                <th class="text-danger">Deuda x pagar</th>
                                                <th>Proveedor</th>
                                                <th>Recibidor</th>
                                                <th>Almacén</th>
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
                <h5 class="modal-title text-white" id="editModalLabel">Cancelar la Deuda de la Compra</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" class="tablelist-form" autocomplete="off" method="post" action="index.php?action=registro">
            <div class="modal-body bg-light">
                <div class="container-fluid">

                    <div class="row">
                        <p>
                            <lord-icon
                                src="https://cdn.lordicon.com/usownftb.json"
                                trigger="loop"
                                delay="1500"
                                stroke="bold"
                                state="in-reveal"
                                colors="primary:#110a5c,secondary:#e86830"
                                style="width:50px;height:50px">
                            </lord-icon> <b>Importante:</b> Antes de proceder a aprobar la cancelación de la deuda, es crucial que consideres que asumirás la responsabilidad exclusiva de esta acción. Una vez validado el monto ingresado para la cancelación, no se podrán efectuar cambios posteriores.
                        </p>
                        <div class="col-md-4">
                            <h6>Compra Nº</h6>
                            <p id="id" class="text-muted"></p>
                            <h6>Fecha</h6>
                            <p id="fecha" class="text-muted"></p>
                            <h6>Proveedor</h6>
                            <p id="proveedores" class="text-muted"></p>
                            <h6>Atendido por</h6>
                            <p id="resposable" class="text-muted"></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Cantidad</h6>
                            <p id="cantidad" class="text-muted"></p>
                            <h6 class="text-info">Adelanto</h6>
                            <p id="adelanto" class="text-muted text-info"></p>
                            <h6>Costo total</h6>
                            <p id="precio" class="text-muted"></p>
                            <h6 class="text-danger">Deudad a pagar</h6>
                            <p id="deuda" class="text-muted text-danger"></p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-primary">Suma de los abonos</h6>
                            <input type="number" class="form-control" readonly="" name="adelantito" id="adelantito">
                            <input type="hidden" class="form-control" readonly="" name="precio" id="preciocompra">
                            <h6 class="text-success">Digite el monto  a abonar</h6>
                            <input type="number" class="form-control" name="adelanto" id="montorestante" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark">
                <div class="hstack gap-2 justify-content-end">
                    <input type="hidden" name="id" id="ids">
                    <input type="hidden" name="actions" value="26">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="add-btn">Validar el abono</button>
                </div>
            </div>
            </form>
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
            "ajax": "index.php?action=apicomprapendiente",
            "columns": [
                { "data": "id",
                    "render": function (data, type, row) {
                        return 'Nº ' + data;
                    }
                },
                { "data": "articulos",
                    "render": function (data, type, row) {
                        return  data;
                    }
                },
                { "data": "cantidad",
                    "render": function (data, type, row) {
                        return '' + data + ' ' + row.unidades;
                    }
                },
                { "data": "adelanto",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data);
                    }
                },
                { "data": "precio",
                    "render": function (data, type, row) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data*row.cantidad);
                    }
                },
                { "data": "precio",
                    "render": function (data, type, row) {
                        if (row.adelanto>=data) {
                            return '<span style="color: green;">$ 0</span>';
                        } else {
                            var formattedPrice = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(data - row.adelanto);
                            return '<span style="color: red;">' + formattedPrice + '</span>';
                        }
                    }
                },
                { "data": "proveedores",
                    "render": function (data, type, row) {
                        return '' + data;
                    }
                },
                { "data": "resposable" },
                { "data": "almacenes" },
                { "data": "fecha" },
                { 
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '"><i class="ri-coins-line align-bottom me-1"></i></button>';
                    }
                }
            ],
            "rowCallback": function(row, data) {
                if (data.estado == 0 | data.estado == 1) { // Cambiar "estado" por el nombre correcto de la columna que indica el estado
                    $(row).css('background-color', 'rgba(255, 0, 0, 0.1)'); // Cambiar el color de fondo de la fila a rojo
                } else {
                    $(row).css('background-color', 'rgba(0, 255, 0, 0.1)');
                }
                // if (data.estado == 2) {
                //     $(row).css('background-color', 'rgba(0, 255, 0, 0.1)'); // Verde más tenue
                // }
            },
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
            $.get("index.php?action=getcomprapendiente&id=" + id, function(data) {
                $('#id').text('#'+data.id);
                $('#proveedores').text(data.proveedores);
                $('#resposable').text(data.resposable);
                $('#cantidad').text(data.cantidad);
                $('#adelanto').text(data.adelanto);
                $('#adelantito').val(data.adelanto);
                $('#precio').text(data.precio);
                $('#preciocompra').val(data.precio);
                $('#abono').text(data.total);
                $('#deuda').text(data.precio-data.adelanto);
                $('#montorestante').val(data.precio-data.adelanto);

                var tipoVenta = data.tipoventa;
                    if (tipoVenta === 1) {
                        $('#tipo_compras').text("Venta al contado");
                    } else if (tipoVenta === 2) {
                        $('#tipo_compras').text("Venta a crédito");
                    } else if (tipoVenta === 0) {
                        $('#tipo_compras').text("Método no asignado");
                    } else {
                        // Mensaje por defecto si el valor de tipoVenta no coincide con ninguno de los casos anteriores
                        $('#tipo_compras').text("Tipo de venta no reconocido");
                    }

        // Formateo como moneda
                $('#subtotal').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.subtotal)));
                $('#descuento').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.descuento)));
                $('#iva').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.iva)));
                $('#total').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.total)));
                $('#adelanto').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.adelanto)));
                $('#restante').text(new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(parseFloat(data.restante)));
                $('#recibidores').text(data.clientes);
                $('#atendedor').text(data.usuarios);
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