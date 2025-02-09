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
                            <h5 class="card-title mb-0 text-white text-center">Información del Inventario</h5>
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
                                        <th>Stock</th>
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
<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": "index.php?action=apiinventario",
            "columns": [
                { "data": "nombre" },
                { "data": "categorias" },
                { "data": "codigo" },
                { "data": "marca" },
                { "data": "modelo" },
                { "data": "serie" },
                { 
                    "data": "cantidad_disponible",
                    "render": function(data, type, row) {
                        return '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">' +
                                    '<div class="btn-group" role="group">' +
                                        '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">' +
                                            'Saldo <b>' + data + '</b>' +
                                        '</button>' +
                                        '<ul class="dropdown-menu" aria-labelledby="btnGroupDrop' + data + '">' +
                                        '</ul>' +
                                    '</div>' +
                               '</div>';
                    }
                }
            ],
            "createdRow": function(row, data, dataIndex) {
            obtenerCantidadPorAlmacen(data.id, function(cantidades) {
                var saldoTotal = 0;
                cantidades.forEach(function(cantidad) {
                    saldoTotal += cantidad.total_almacen;
                    $(row).find('.dropdown-menu').append('<li><a class="dropdown-item" href="#">' + cantidad.nombre_almacen + ': ' + cantidad.total_almacen + '</a></li>');
                });
                $('#saldo_' + data.id).text(saldoTotal);
            });
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
        function obtenerCantidadPorAlmacen(productoId, callback) {
            $.ajax({
                url: 'index.php?action=apicantidadporalmacen',
                method: 'GET',
                data: { producto_id: productoId },
                success: function(response) {
                    var cantidades = JSON.parse(response);
                    callback(cantidades);
                }
            });
        }
    });
</script>