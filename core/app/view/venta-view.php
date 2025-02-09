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
                                            src="https://cdn.lordicon.com/jtiihjyw.json"
                                            trigger="loop"
                                            state="loop-spin"
                                            colors="primary:#1b1091,secondary:#ffc738,tertiary:#ffffff"
                                            style="width:100px;height:100px">
                                        </lord-icon>
                                    </div>
                                    <h4 class="mb-3">Venta # <?php echo isset($_SESSION['numero_compra']) ? $_SESSION['numero_compra'] : ''; ?></h4>
                                    <div class="form-group">
                                        <label for="printOption" class="form-label">Elija el tipo del comprobante:</label>
                                        <select id="printOption" class="form-select">
                                            <option value="">Seleccionar documento</option>
                                            <option value="index.php?action=ticketventa&tid=<?php echo $_SESSION['numero_compra']; ?>">Ticket</option>
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
                            <h5 class="card-title mb-0 text-white">Registro de Ventas</h5>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="tablelist-form" autocomplete="off" method="post" action="index.php?action=registro">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="select-articulo" class="form-label text-primary">Articulo</label>
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
                                    <div style="background-color: #f2f2f2;" class="col-md-5">
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
                                    <div class="col-md-3">
                                        <label for="basiInput" class="form-label text-primary">Almacén</label>
                                        <select name="almacen" id="almacen" class="form-control miSelect1">
                                            <option value="">Selecionar</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="data-cantidadd" name="cantidadd" class="form-control">
                                    <div class="col-md-2">
                                        <label for="cantidad" class="form-label text-primary">Cantidad</label>
                                        <input type="text" name="cantidad" id="cantidad" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="precioventa" class="form-label text-primary">Precio venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text">MXN</span>
                                            <input type="text" name="precioventa" id="precioventa" class="form-control">
                                        </div>
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
                                            <th width="80px">P. Venta</th>
                                            <th width="120px">SubTotal</th>
                                            <th width="80px">P. V. config.</th>
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
                                    <div class="col-md-6 row mb-0">
                                        <div class="col-md-4">
                                            <label for="tipoventa" class="form-label text-primary">Método venta</label>
                                            <select name="tipoventa" id="tipoventa" class="form-select tipoventa" aria-label="Default select example">
                                                <option value="contado">Al cotado</option>
                                                <option value="credito">Al credito</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="adelantoContainer" style="display: none;">
                                            <label for="adelanto" class="form-label text-primary">Adelanto</label>
                                            <input type="text" name="adelanto" id="adelanto" class="form-control">
                                        </div>
                                        <div class="col-md-4" id="comprobantes" style="display: none;">
                                            <label for="comprobante" class="form-label text-primary">Nº Comprobante</label>
                                            <input type="text" name="comprobante" id="comprobante" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="accion" class="form-label text-primary">Tipo venta</label>
                                            <select name="accion" id="accion" class="form-select" aria-label="Default select example">
                                                <option value="1">Venta Estandarizada</option>
                                                <option value="2">Cotización</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="factura" class="form-label text-primary">Factura/Folio</label>
                                            <textarea rows="1" class="form-control" name="factura"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="cliente" class="form-label text-primary">Cliente</label>
                                            <select name="cliente" id="cliente" class="form-select miSelect1 proveedores" aria-label="Default select example">
                                                <option value="">Seleccionar</option>
                                                <?php
                                                $clientes = ClienteData::vercontenido();
                                                foreach ($clientes as $clints) { ?>
                                                    <option value="<?= $clints->id; ?>"><?= $clints->nombre; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="descripcion" class="form-label text-primary">Descripción de la venta</label>
                                            <textarea class="form-control" name="descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    <input type="hidden" name="actions" value="23">
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-info btnguardar w-100" id="add-btn">Registrar Venta</button>
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
        if ($('#tipoventa').val() === 'contado') {
            $('#adelantoContainer').hide();
            $('#comprobantes').hide();
        }
        $('#tipoventa').change(function() {
            if ($(this).val() === 'credito') {
                $('#adelantoContainer').show();
                $('#comprobantes').show();
            } else {
                $('#adelantoContainer').hide();
                $('#comprobantes').hide();
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
    $('#select-articulo').change(function(){
        var Idproductos = $(this).val(); 
        if (Idproductos) {
            $.ajax({
                url: 'index.php?action=apicantidadporalmacen1',
                type: 'GET',
                data: { producto_id: Idproductos },
                success: function(data) {
                    console.log("Datos recibidos: ", data);
                    console.log("Entrando en la función success");

                    $('#almacen').empty().append('<option value="">Seleccionar</option>');
                    if (Array.isArray(data) && data.length > 0) {
                        $.each(data, function(key, value) {
                            if (value && value.id_almacen && value.nombre_almacen && value.total_almacen) {
                                $('#almacen').append('<option value="' + value.id_almacen + '" data-cantidadd="' + value.total_almacen + '">' + value.nombre_almacen + ' (' + value.total_almacen + ')</option>');
                            }
                        });
                        console.log("Opciones añadidas: ", $('#almacen').html());
                    } else {
                        console.log("Los datos no son un array o están vacíos");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud: ", error);
                }
            });
        } else {
            $('#almacen').empty().append('<option value="">Seleccionar</option>');
        }
    });
    $('#almacen').on('change', function() {
        var cantidadDisponible = $(this).find('option:selected').data('cantidadd');
        $('#data-cantidadd').val(cantidadDisponible);
    });
    $('#cantidad').on('input', function() {
        actualizarPrecioVenta();
        var cantidadMaxima = $('#data-cantidadd').val();
        // var cantidaunidad = $('#cantidad_unidad').val();
        // var cantidadIngresada = cantidaunidad*$(this).val();
        var cantidadIngresada = $(this).val();

        if (parseInt(cantidadIngresada) > parseInt(cantidadMaxima)) {
            $(this).val(cantidadMaxima);
        }

        // var cantidad = $(this).val();
        // var precioUnitario = $('#precio_unidad').val();
        // if ($.isNumeric(cantidad) && $.isNumeric(precioUnitario)) {
        //     var precioVenta = parseFloat(cantidad) * parseFloat(precioUnitario);
        //     $('#precioventa').val(precioVenta.toFixed(2)); //
        // } else {
        //     $('#precioventa').val('');
        // }
    });
    $('#unidad').change(function() {
        actualizarPrecioVenta();
    });

    function actualizarPrecioVenta() {
        // var cantidad = $('#cantidad').val();
        // var precioUnitario = $('#precio_unidad').val();
        // if ($.isNumeric(cantidad) && $.isNumeric(precioUnitario)) {
        //     var precioVenta = parseFloat(cantidad) * parseFloat(precioUnitario);
        //     $('#precioventa').val(precioVenta.toFixed(2));
        // } else {
        //     $('#precioventa').val('');
        // }
        var cantidad = $('#cantidad').val();
        var precioUnitario = $('#precio_unidad').val();
        if ($.isNumeric(cantidad) && $.isNumeric(precioUnitario)) {
            var precioVenta = parseFloat(precioUnitario);
            $('#precioventa').val(precioVenta.toFixed(2));
        } else {
            $('#precioventa').val('');
        }
    }
    actualizarPrecioVenta();

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
        var precio = parseFloat($('input[name="precioventa"]').val());
        var almacen1 = $('select[name="almacen"] option:selected').text();
        var almacen = $('#almacen').val();

        var cantidad_unidad = parseFloat($('input[name="cantidad_unidad"]').val());
        var precio_unidad = parseFloat($('input[name="precio_unidad"]').val());
        var cantidadd = parseFloat($('input[name="cantidadd"]').val());

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
        if (almacen == "") {
            $('select[name="almacen"]').next('.select2-container').addClass('campo-faltante'); 
            $('select[name="almacen"]').select2('open'); 
            return;
        } else {
            $('select[name="almacen"]').next('.select2-container').removeClass('campo-faltante'); 
        }
        var cantidads = $('#cantidad').val();
        if (cantidads == "") {
            $('input[name="cantidad"]').addClass('campo-faltante').focus();
            return;
        } else {
            $('input[name="cantidad"]').removeClass('campo-faltante');
        }
        var precios = $('#precioventa').val();
        if (precios == "") {
            $('input[name="precioventa"]').addClass('campo-faltante').focus(); 
            return;
        } else {
            $('input[name="precioventa"]').removeClass('campo-faltante'); 
        }
        if (cantidadd == "") {
            $('select[name="cantidadd"]').next('.select2-container').addClass('campo-faltante');
            $('select[name="cantidadd"]').select2('open'); 
            return;
        } else {
            $('select[name="cantidadd"]').next('.select2-container').removeClass('campo-faltante'); 
        }
        
        var newRow = `<tr>
            <td><input type="hidden" name="articulo_[]" value="${articulo}" />${articulo1}</td>
            <td><input type="hidden" name="unidad_[]" value="${unidad1}">${unidad}</td>
            <td><input type="number" name="cantidadProducto_[]" value="${cantidad}" style="width: 50px;" /></td>
            <td><input type="hidden" name="cantidad_unidad_[]" value="${cantidad_unidad}" /><input type="number" name="precioProducto_[]" value="${precio.toFixed(2)}" style="width: 60px;" /></td>
            <td class="subtotalProducto">${(cantidad * precio).toFixed(2)} MXN</td>
            <td><input type="hidden" name="precio_unidad_[]" value="${precio_unidad}" />${precio_unidad}</td>
            <td><input type="hidden" name="cantidad_[]" value="${cantidad}" /><input type="hidden" name="almacen_[]" value="${almacen}" />${almacen1}</td>
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
        $('input[name="cantidadd"]').val('');
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