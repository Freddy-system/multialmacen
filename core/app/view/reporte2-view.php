<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Reporte de Artículos por Rango de Fecha</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <form>
                                        <div class="row align-items-end">
                                            <div class="col-md-4">
                                                <label for="desde" class="font-weight-bold">Desde:</label>
                                                <input type="date" name="desde" id="desde" class="form-control" value="<?php echo isset($_GET["desde"]) ? $_GET["desde"] : ''; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="hasta" class="font-weight-bold">Hasta:</label>
                                                <input type="date" name="hasta" id="hasta" class="form-control" value="<?php echo isset($_GET["hasta"]) ? $_GET["hasta"] : ''; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-success btn-block align-self-end">Procesar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($_GET['desde']) && isset($_GET['hasta'])) {
                                    if ($_GET['desde']!="" && $_GET['hasta']!="") {
                                    $operaciones = array();
                                    $operaciones = ArticuloData::reporte1($_GET['desde'],$_GET['hasta']);
                                    $contador=0;
                                    if (count($operaciones)>0) { ?>
                                    <table id="reportestable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Articulo</th>
                                                <th>Categoria</th>
                                                <th>Código</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Serie</th>
                                                <th>Stock</th>
                                                <th>Imagen</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($operaciones as $op) { ?>
                                            <tr>
                                                <td><?= $op->nombre; ?></td>
                                                <td><?= $op->categorias; ?></td>
                                                <td><?= $op->codigo; ?></td>
                                                <td><?= $op->marca; ?></td>
                                                <td><?= $op->modelo; ?></td>
                                                <td><?= $op->serie; ?></td>
                                                <td><?php 
                                                $totaldis = ProcesoData::cantidadTotalProducto($op->id);
                                                if ($totaldis != null) {
                                                    echo $totaldis->total;
                                                } else {
                                                    echo "0";
                                                }
                                                ?></td>
                                                <td><img style="width: 10%;" <?php if ($op->imagen=="") { ?>
                                                    src="storage/per/logo.png"
                                                <?php } else { ?>
                                                    src="storage/archivo/<?= $op->imagen;?>"
                                               <?php } ?>></td>
                                                <td><?= $op->fecha; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } else {
                                        echo "sin data";
                                    }
                                    }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#reportestable')) {
        $('#reportestable').DataTable().destroy();
    }

    $('#reportestable').DataTable({
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ elementos",
            info: "Mostrando desde _START_ al _END_ de _TOTAL_ elementos",
            infoEmpty: "Mostrando ningún elemento.",
            infoFiltered: "(filtrado _MAX_ elementos total)",
            infoPostFix: "",
            loadingRecords: "Cargando registros...",
            zeroRecords: "No se encontraron registros",
            emptyTable: "No hay datos disponibles en la tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            buttons: {
                copyTitle: 'Copiado al portapapeles',
                copySuccess: {
                    _: '%d filas copiadas',
                    1: '1 fila copiada'
                }
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function (doc) {
                    // Cambiar la fuente del PDF a Arial
                    doc.defaultStyle.font = 'Arial';
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
});
</script>