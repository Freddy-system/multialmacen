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
                <div class="col">
                    <!-- ***************************************************** -->
                    <div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center p-5">
                                    <div class="mb-4">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/guothkao.json"
                                            trigger="loop"
                                            delay="2000"
                                            style="width:120px;height:120px">
                                        </lord-icon>
                                    </div>
                                    <h4 class="mb-3">Compra # <?php echo isset($_SESSION['numero_compra']) ? $_SESSION['numero_compra'] : ''; ?></h4>
                                    <div class="form-group">
                                        <label for="printOption" class="form-label">Elija el tipo del comprobante:</label>
                                        <select id="printOption" class="form-select">
                                            <option value="">Seleccionar documento</option>
                                            <option value="index.php?action=ticketcompra&tid=<?php echo $_SESSION['numero_compra']; ?>">Ticket</option>
                                            <!-- <option value="factura.php">Factura</option> -->
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="button" class="btn btn-outline-secondary me-3" data-bs-dismiss="modal"><i class="ri-close-line me-1"></i>Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.getElementById('printOption').addEventListener('change', function() {
                            var selectedOption = this.value;
                            if (selectedOption) {
                                window.open(selectedOption, '_blank');
                            }
                        });
                    </script>
                    <?php   if (isset($_SESSION['numero_compra'])) {
                        unset($_SESSION['numero_compra']);
                        }
                        if (isset($_SESSION['show_modal']) && $_SESSION['show_modal']) {
                            echo '<script>$(document).ready(function() { $("#showModal").modal("show"); });</script>';
                            unset($_SESSION['show_modal']); 
                        }
                    ?>
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
                    <!-- ************************************************************* -->
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0 text-white">Registro de Compras</h5>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="tablelist-form" autocomplete="off" method="post" action="index.php?action=registro">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="basiInput" class="form-label text-primary">Articulo</label>
                                        <select name="articulo" id="select-articulo" class="form-select miSelect1 rounded-pill mb-3" aria-label="Default select example">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $articulos = ArticuloData::vercontenido();
                                            foreach ($articulos as $arti) { ?>
                                                <option value="<?= $arti->id; ?>"><?= $arti->nombre; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div style="background-color: #f2f2f2;" class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="unidad" class="form-label text-primary">Unidad</label>
                                                <select name="unidad" id="unidad" class="form-control"><option value="">Seleccionar</option></select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cantidad_unidad" class="form-label text-primary">Cantidad</label>
                                                <input type="number" readonly="readonly" name="cantidad_unidad" class="form-control" id="cantidad_unidad">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="precio_unidad" class="form-label text-primary">P. venta</label>
                                                <input type="number" readonly="readonly" name="precio_unidad" class="form-control" id="precio_unidad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="tipocompra" class="form-label text-primary">Método compra</label>
                                        <select name="tipocompra" id="tipocompra" class="form-select tipocompra" aria-label="Default select example">
                                            <option value="contado">Al cotado</option>
                                            <option value="credito">Al credito</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="cantidad" class="form-label text-primary">Cantidad</label>
                                        <input type="text" name="cantidad" id="cantidad" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="precio" class="form-label text-primary">Precio Compra</label>
                                        <input type="text" name="precio" id="precio" class="form-control">
                                    </div>
                                    <div class="col-md-1" id="adelantoContainer" style="display: none;">
                                        <label for="adelanto" class="form-label text-primary">Adelanto</label>
                                        <input type="text" name="adelanto" id="adelanto" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basiInput" class="form-label text-primary">Proveedor</label>
                                        <select name="proveedor" id="proveedor" class="form-select miSelect1 proveedores" aria-label="Default select example">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $clientes = ClienteData::vercontenido();
                                            foreach ($clientes as $clints) { ?>
                                                <option value="<?= $clints->id; ?>"><?= $clints->nombre; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="basiInput" class="form-label text-primary">Almacén</label>
                                        <select name="almacen" id="almacen" class="form-select miSelect1" aria-label="Default select example">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $bodegas = AlmacenData::vercontenido();
                                            foreach ($bodegas as $bode) { ?>
                                                <option value="<?= $bode->id; ?>"><?= $bode->nombre; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="basiInput" class="form-label text-primary">Factura/Folio</label>
                                        <textarea rows="1" class="form-control" name="factura"></textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                                <button id="btnAgregar" title="Agregar a la lista" class="btn btn-info btnguardar w-100"><i class="ri-add-line align-bottom me-1"> </i> </button>
                                            </div>
                                </div>
                                <hr>
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%; font-size: 10px;">
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th>Articulo</th>
                                            <th>Unidad</th>
                                            <th width="80px">Cantidad</th>
                                            <th width="80px">P. Compra</th>
                                            <th width="120px">SubTotal</th>
                                            <th>proveedor</th>
                                            <th>Almacén</th>
                                            <th width="5px"><i class="ri-delete-bin-2-line"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="subtotal" class="form-label fs-6">Subtotal</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white">$</span>
                                                <input type="text" class="form-control rounded-pill border-primary" name="subtotal" id="subtotal" readonly>
                                                <span class="input-group-text bg-primary text-white">MXN</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="descuento" class="form-label fs-6">Descuento</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-white">$</span>
                                                <input type="text" class="form-control rounded-pill border-warning" name="descuento" id="descuento" placeholder="Aplica descuento...">
                                                <span class="input-group-text bg-warning text-white">MXN</span>
                                            </div>
                                        </div>
                                        <div class="mb-2 form-check">
                                            <input type="checkbox" class="form-check-input" id="igv">
                                            <label class="form-check-label text-secondary fs-6" for="igv">Aplicar IVA del 16%</label>
                                        </div>
                                        <div class="mb-2">
                                            <label for="total-igv" class="form-label fs-6">Total IVA</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">$</span>
                                                <input type="text" class="form-control rounded-pill border-success" name="igv" id="total-igv" readonly>
                                                <span class="input-group-text bg-success text-white">MXN</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="total" class="form-label fs-6">Total</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-danger text-white">$</span>
                                                <input type="text" class="form-control rounded-pill border-danger" name="total" id="total" readonly>
                                                <span class="input-group-text bg-danger text-white">MXN</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <input type="hidden" name="actions" value="22">
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-info btnguardar w-100" id="add-btn">Registrar Compra</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#tipocompra').val() === 'contado') {
            $('#adelantoContainer').hide();
        }
        $('#tipocompra').change(function() {
            if ($(this).val() === 'credito') {
                $('#adelantoContainer').show();
            } else {
                $('#adelantoContainer').hide();
            }
        });
    });
</script>
<script>
$(document).ready(function(){
    $('#select-articulo').change(function(){
        var productoID = $(this).val(); 
        if(productoID){
            $.ajax({
                type:'POST',
                url:'index.php?action=apiprecios', 
                data:'id_producto='+productoID,
                success:function(data){
                    $('select[name="unidad"]').html('<option value="">Seleccionar</option>' + data);
                    $('input[name="cantidad_unidad"]').val('');
                    $('input[name="precio_unidad"]').val(''); 
                }
            }); 
        } else {
            // Si no se selecciona ningún producto, limpiar y mostrar la opción nula
            $('select[name="unidad"]').html('<option value="">Seleccionar</option>');  
            $('input[name="cantidad_unidad"]').val('');
            $('input[name="precio_unidad"]').val('');
        }
    });
    
    $('select[name="unidad"]').change(function(){
        var cantidad_unidad = $(this).find('option:selected').data('cantidad');  
        var precio_unidad = $(this).find('option:selected').data('precio');
        
        if (cantidad_unidad !== undefined && precio_unidad !== undefined) {
            $('input[name="cantidad_unidad"]').val(cantidad_unidad);
            $('input[name="precio_unidad"]').val(precio_unidad);
        } else {
            $('input[name="cantidad_unidad"]').val('');
            $('input[name="precio_unidad"]').val('');
        }
    });
});
</script>
<style>
    .campo-faltante {
        border-color: red !important;
    }
</style>
<script>
    function actualizarEstadoBoton() {
            if ($('table tbody tr').length > 0) {
                $('#add-btn').prop('disabled', false);
            } else {
                $('#add-btn').prop('disabled', true);
            }
        }
        actualizarEstadoBoton();
    $('#btnAgregar').on('click', function(e) {
        e.preventDefault();

        var articulo = $('#select-articulo').val();
        var articulo1 = $('select[name="articulo"] option:selected').text();
        var unidad = $('select[name="unidad"] option:selected').text();
        var unidad1 = $('select[name="unidad"]').val();
        var cantidad = parseFloat($('input[name="cantidad"]').val());
        var cantidad_unidad = parseFloat($('input[name="cantidad_unidad"]').val());
        var precio = parseFloat($('input[name="precio"]').val());
        var almacen1 = $('select[name="almacen"] option:selected').text();
        var almacen = $('#almacen').val();

        var proveedor = $('select[name="proveedor"]').val();
        var proveedor1 = $('select[name="proveedor"] option:selected').text();
        var factura = $('textarea[name="factura"]').val();
        var tipocompra = $('#tipocompra').val();
        var tipocompra1 = $('select[name="tipocompra"] option:selected').text();
        var adelanto = parseFloat($('input[name="adelanto"]').val());
        if (articulo == "") {
            $('select[name="articulo"]').next('.select2-container').addClass('campo-faltante');
            $('select[name="articulo"]').select2('open');
            return;
        } else {
            $('select[name="articulo"]').next('.select2-container').removeClass('campo-faltante'); 
        }
        var unidads = $('#unidad').val();
        if (unidads == "") {
            $('select[name="unidad"]').addClass('campo-faltante').focus(); 
            return;
        } else {
            $('select[name="unidad"]').removeClass('campo-faltante'); 
        }
        var cantidads = $('#cantidad').val();
        if (cantidads == "") {
            $('input[name="cantidad"]').addClass('campo-faltante').focus();
            return;
        } else {
            $('input[name="cantidad"]').removeClass('campo-faltante');
        }
        var precios = $('#precio').val();
        if (precios == "") {
            $('input[name="precio"]').addClass('campo-faltante').focus(); 
            return;
        } else {
            $('input[name="precio"]').removeClass('campo-faltante'); 
        }
        if (proveedor == "") {
            $('select[name="proveedor"]').next('.select2-container').addClass('campo-faltante');
            $('select[name="proveedor"]').select2('open'); 
            return;
        } else {
            $('select[name="proveedor"]').next('.select2-container').removeClass('campo-faltante'); 
        }
        if (almacen == "") {
            $('select[name="almacen"]').next('.select2-container').addClass('campo-faltante'); 
            $('select[name="almacen"]').select2('open'); 
            return;
        } else {
            $('select[name="almacen"]').next('.select2-container').removeClass('campo-faltante'); 
        }

        var newRow = `<tr>
            <td><input type="hidden" name="articulo_[]" value="${articulo}" />${articulo1}</td>
            <td><input type="hidden" name="unidad[]" value="${unidad1}"><input type="hidden" name="cantidad_unidad[]" value="${cantidad_unidad}">${unidad}</td>
            <td><input type="number" name="cantidadProducto_[]" value="${cantidad}" style="width: 50px;" /></td>
            <td><input type="hidden" name="factura_[]" value="${factura}" /><input type="number" name="precioProducto_[]" value="${precio.toFixed(2)}" style="width: 60px;" /></td>
            <td class="subtotalProducto">${(cantidad * precio).toFixed(2)} MXN</td>
            <td><input type="hidden" name="proveedor_[]" value="${proveedor}" />${proveedor1}</td>
            <td><input type="hidden" name="tipocompra_[]" value="${tipocompra}" /><input type="hidden" name="adelanto_[]" value="${adelanto}" /><input type="hidden" name="almacen_[]" value="${almacen}" />${almacen1}</td>
            <td><button class="btn btn-danger btn-sm btnEliminar"><i class="ri-delete-bin-2-line"></i></button></td>
        </tr>`;

        $('table tbody').append(newRow);

        $('#select-articulo').val('').trigger('change');
        $('select[name="unidad"]').empty().append('<option value="">Seleccionar</option>');
        $('input[name="cantidad"]').val('');
        $('input[name="precio"]').val('');
        $('select[name="moneda"]').val('BS');
        $('#proveedor').val('').trigger('change');
        $('#almacen').val('').trigger('change');
        $('input[name="cantidad_unidad"]').val('');
        $('input[name="precio_unidad"]').val('');
        $('textarea[name="factura"]').val('');
        $('input[name="adelanto"]').val('');
        calcularTotales();
        actualizarEstadoBoton();
    });
    $(document).on('input', 'input[name="cantidadProducto_[]"], input[name="precioProducto_[]"]', function() {
        let $row = $(this).closest('tr');
        let cantidad = parseFloat($row.find('input[name="cantidadProducto_[]"]').val()) || 0;
        let precio = parseFloat($row.find('input[name="precioProducto_[]"]').val()) || 0;
        $row.find('.subtotalProducto').text((cantidad * precio).toFixed(2));
        calcularTotales();
    });
    $(document).on('click', '.btnEliminar', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
        calcularTotales();
        actualizarEstadoBoton();
    });
    function calcularTotales() {
        let subtotal = 0;
        $('.subtotalProducto').each(function() {
            subtotal += parseFloat($(this).text());
        });
        let descuento = parseFloat($('#descuento').val()) || 0;
        if (descuento > subtotal) {
            $('#descuento').val(subtotal.toFixed(2));
            descuento = subtotal; 
        }
        let iva = 0;
        if ($('#igv').is(':checked')) {
            iva = (subtotal - descuento) * 0.16;
        }
        let total = subtotal - descuento + iva;
        $('#subtotal').val(subtotal.toFixed(2));
        $('#total-igv').val(iva.toFixed(2));
        $('#total').val(total.toFixed(2));
        $('#total1').val(total.toFixed(2));
    }
    $(document).on('input', '#descuento, #igv', calcularTotales);
</script>