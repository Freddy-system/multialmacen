<?php $datitos = VentaData::verid($_GET['tid']); 
function formato_soles($monto) {
    $simbolo_moneda = "$";
    if ($monto !== null) {
        $monto_formateado = number_format($monto, 2, '.', ',');
        $monto_formateado = $simbolo_moneda . $monto_formateado;
        return $monto_formateado;
    } else {
        return "0"; 
    }
}
$totalcantidad = 0;
$totalcosto = 0;
 ?>
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
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0 text-white text-center text-uppercase">Detalle de Venta</h5>
                                </div>
                                <div class="card-body bg-light">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><i class="ri-file-list-3-line text-primary"></i> <span id="id" class="text-muted">Compra Nº: #<?= $datitos->id; ?></span></p>
                                                <p><i class="ri-home-2-line text-primary"></i> <span id="sucursales1" class="text-muted">Cliente: <?= $datitos->clientes; ?></span></p>
                                                <p><i class="ri-home-2-line text-primary"></i> <span id="sucursales1" class="text-muted">Vendedor: <?= $datitos->usuarios; ?></span></p>
                                                <p><i class="ri-home-2-line text-primary"></i> <span id="sucursales1" class="text-muted">Fecha: <?= $datitos->fecha; ?></span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><i class="ri-shopping-bag-2-line text-primary"></i> <span id="tipo_compras" class="text-muted">Subtotal:  <?= formato_soles($datitos->subtotal); ?></span></p>
                                                <p><i class="ri-hand-coin-line text-primary"></i> <span id="adelanto" class="text-muted">Descuento: <?= formato_soles($datitos->descuento); ?></span></p>
                                                <p><i class="ri-bank-line text-primary"></i> <span id="restante" class="text-muted">Igv: <?= formato_soles($datitos->igv); ?></span></p>
                                                <p><i class="ri-bank-line text-primary"></i> <span id="restante" class="text-muted">Total: <?= formato_soles($datitos->total); ?></span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><i class="ri-shopping-bag-2-line text-primary"></i> <span id="tipo_compras" class="text-muted">Factura:  <?= $datitos->numerofacfoli; ?></span></p>
                                                <p><i class="ri-hand-coin-line text-primary"></i> <span id="adelanto" class="text-muted">Método venta: <?php if ($datitos->tipoventa==1) {
                                                    echo "Al contado";
                                                }
                                                if ($datitos->tipoventa==2) {
                                                    echo "Al crédito";
                                                }
                                                if ($datitos->tipoventa==0) {
                                                    echo "Sin método";
                                                } ?></span></p>
                                                <p><i class="ri-bank-line text-primary"></i> <span id="restante" class="text-muted">Descripción de la venta: <?= $datitos->descripcion; ?></span></p>
                                                <p><i class="ri-bank-line text-primary"></i> <span id="restante" class="text-muted">Adelanto: <?= formato_soles($datitos->adelanto); ?> Comprobante: <?= $datitos->comprobante; ?></span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <table id="miTabla" class="table table-borderless table-responsive" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Items</th>
                                                    <th>Producto</th>
                                                    <!-- <th>Unidad</th> -->
                                                    <th>Cantidad</th>
                                                    <th>Costo Total</th>
                                                    <th>Almacén</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $datas = ProcesoData::vercontenidos1($_GET['tid']);
                                                foreach ($datas as $data) {
                                                    $totalcantidad += $data->cantidad;
                                                    $totalcosto += $data->precio;
                                                ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?= $data->articulos; ?></td>
                                                        <!-- <td><?= $data->unidades; ?></td> -->
                                                        <td><?= $data->cantidad/$data->cantidad_unidad." ".$data->unidades; ?></td>
                                                        <td><?= formato_soles($data->precio); ?></td>
                                                        <td><?= $data->almacenes; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="3"># articulos</td>
                                                    <td><?= $totalcantidad; ?></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">Total Csoto de Compra</td>
                                                    <td><?= formato_soles($totalcosto); ?></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-4">
                                            <h6>Emetir Comprobante:</h6>
                                            <div class="form-group">
                                                <select id="printOption" class="form-select">
                                                    <option value="">Seleccionar</option>
                                                    <option value="index.php?action=ticketventa&tid=<?php echo $_GET['tid']; ?>">Ticket</option>
                                                    <!-- <option value="index.php?action=facturaventa&tid=<?php echo $_GET['tid']; ?>">Factura</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
    var table = document.getElementById("miTabla");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length - 2; i++) {
        var cell = rows[i].getElementsByTagName("td")[0];
        cell.innerHTML = i;
    }
</script>

<script>
document.getElementById('printOption').addEventListener('change', function() {
    var selectedOption = this.value;

    if (selectedOption) {
        window.open(selectedOption, '_blank');
    }
});
</script>