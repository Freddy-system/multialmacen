<?php
require 'PHPMailer/PHPMailerAutoload.php';
$database = Database::getInstance();
$mysqli = $database->getConnection();
$actions = $_POST['actions'];
if ($actions==1) {
    $c = ClienteData::duplicidad($_POST['ci']);
        if ($c == null) {
           $registro = new ClienteData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: cliente");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: cliente");
        }
}
if ($actions==2) {
    $registro = new ClienteData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    if (ClienteData::evitarladuplicidad($_POST['ci'], $_POST['id'])) {
        $_SESSION['success_messagea1'] = "El CI ya existe en otro registro.";
        header("Location: cliente");
        exit;
    }
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: cliente");
}
if ($actions==3) {
    $eliminar = ClienteData::verid($_POST["id"]);
    $eliminar->eliminar();
    $_SESSION['eliminado'] = "Eliminado con éxito.";
    header("Location: cliente");
}
if ($actions==4) {
    $c = UserData::duplicidad($_POST['documento']);
        if ($c == null) {
           $registro = new UserData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $target_dir = "storage/archivo/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "El imagen " . basename($_FILES["imagen"]["name"]) . " ha sido subido.";
            $registro->imagen = basename($_FILES["imagen"]["name"]);
        } else { }
        $registro->usuario = $_POST['documento'];
        $registro->password = password_hash($_POST['documento'], PASSWORD_DEFAULT); 
        $usuario = $registro->registro();

        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: usuario");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: usuario");
        }
}
if ($actions==5) {
    $registro = new UserData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    if (UserData::evitarladuplicidad($_POST['documento'], $_POST['id'])) {
        $_SESSION['success_messagea1'] = "El CI ya existe en otro registro.";
        header("Location: usuario");
        exit;
    }
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen = $_FILES["imagen"]["name"];
        $target_dir = "storage/archivo/";
        $target_file = $target_dir . basename($imagen);
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        }
        $registro->imagen = $imagen;
    } else {
        $registro->imagen = $_POST['imagen1'];
    }

    if ($_POST['usuario']) {
        $registro->usuario=$_POST['usuario'];
        $registro->actualizarusuario();
    }
    if ($_POST['password']) {
        $registro->password=password_hash($_POST['password'], PASSWORD_DEFAULT);
        $registro->actualizarpassword();
    }
    $registro->estado = isset($_POST['estado']) && $_POST['estado'] == 'on';

    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: usuario");
}
if ($actions==6) {
    if ($_SESSION['conticomtc'] == $_POST['id']) {
        $_SESSION['eliminado'] = "No se puede eliminarse a sí mismo.";
    } else {
        try {
            $mysqli->begin_transaction();
            $eliminar = UserData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
    }
    header("Location: usuario");
}
if ($actions==7) {
    $c = ClienteData::duplicidad($_POST['nombre']);
        if ($c == null) {
           $registro = new ClienteData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: cliente");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: cliente");
        }
}
if ($actions==8) {
    $registro = new ClienteData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    if (ClienteData::evitarladuplicidad($_POST['nombre'], $_POST['id'])) {
        $_SESSION['success_messagea1'] = "El CI ya existe en otro registro.";
        header("Location: cliente");
        exit;
    }
    $registro->estado = isset($_POST['estado']) && $_POST['estado'] == 'on';
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: cliente");
}
if ($actions==9) {
    try {
            $mysqli->begin_transaction();
            $eliminar = ClienteData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
    header("Location: cliente");
}
if ($actions==10) {
    $duplicidad=$_POST['nombre'];
    // echo "$duplicidad";
    $c = CategoriaData::duplicidad($duplicidad);
        if ($c == null) {
           $registro = new CategoriaData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: categoria");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: categoria");
        }
}
if ($actions==11) {
    $duplicidad=$_POST['nombre'];
    $registro = new CategoriaData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    $registro->duplicidad=$duplicidad;
    if (CategoriaData::evitarladuplicidad($duplicidad, $_POST['id'])) {
        $_SESSION['success_messagea1'] = "Ya existe en otro registro similar.";
        header("Location: categoria");
        exit;
    }
    $registro->estado = isset($_POST['estado']) && $_POST['estado'] == 'on';
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: categoria");
}
if ($actions==12) {
    try {
            $mysqli->begin_transaction();
            $eliminar = CategoriaData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
        header("Location: categoria");
}
if ($actions==13) {
    $duplicidad=$_POST['nombre'];
    $c = AlmacenData::duplicidad($duplicidad);
        if ($c == null) {
           $registro = new AlmacenData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: almacen");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: almacen");
        }
}
if ($actions==14) {
    $duplicidad=$_POST['nombre'];
    $registro = new AlmacenData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    $registro->duplicidad=$duplicidad;
    if (AlmacenData::evitarladuplicidad($duplicidad, $_POST['id'])) {
        $_SESSION['success_messagea1'] = "Ya existe en otro registro similar.";
        header("Location: almacen");
        exit;
    }
    $registro->estado = isset($_POST['estado']) && $_POST['estado'] == 'on';
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: almacen");
}
if ($actions==15) {
    try {
            $mysqli->begin_transaction();
            $eliminar = AlmacenData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
        header("Location: almacen");
}
if ($actions==16) {
    $c = ArticuloData::duplicidad($_POST['codigo']);
        if ($c == null) {
           $registro = new ArticuloData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $target_dir = "storage/archivo/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "El imagen " . basename($_FILES["imagen"]["name"]) . " ha sido subido.";
            $registro->imagen = basename($_FILES["imagen"]["name"]);
        } else { }
        $registro->par = isset($_POST['par']) && $_POST['par'] == 'on';
        $usuario = $registro->registro();

        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: articulo");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: articulo");
        }
}
if ($actions==17) {
    $registro = new ArticuloData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    if (ArticuloData::evitarladuplicidad($_POST['codigo'], $_POST['id'])) {
        $_SESSION['success_messagea1'] = "Ya existe en otro registro.";
        header("Location: articulo");
        exit;
    }
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen = $_FILES["imagen"]["name"];
        $target_dir = "storage/archivo/";
        $target_file = $target_dir . basename($imagen);
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        }
        $registro->imagen = $imagen;
    } else {
        $registro->imagen = $_POST['imagen1'];
    }
    $registro->par = isset($_POST['par']) && $_POST['par'] == 'on';
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: articulo");
}
if ($actions==18) {
    try {
            $mysqli->begin_transaction();
            $eliminar = ArticuloData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
        header("Location: articulo");
}
if ($actions==19) {
    $duplicidad=$_POST['nombre'].$_POST['sucursal'];
    $c = CargoData::duplicidadd($duplicidad);
        if ($c == null) {
           $registro = new CargoData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: cargo");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: cargo");
        }
}
if ($actions==20) {
    $duplicidad=$_POST['nombre'].$_POST['sucursal'];
    $registro = new CargoData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    $registro->duplicidad=$duplicidad;
    if (CargoData::evitarladuplicidad($duplicidad, $_POST['id'])) {
        $_SESSION['success_messagea1'] = "Ya existe en otro registro similar.";
        header("Location: cargo");
        exit;
    }
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: cargo");
}
if ($actions==21) {
    try {
            $mysqli->begin_transaction();
            $eliminar = CargoData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
        header("Location: cargo");
}
if ($actions==22) {
    $usuario=$_SESSION['conticomtc'];
    $registro = new CompraData();
    $registro->subtotal=$_POST['subtotal'];
    $registro->descuento=$_POST['descuento'];
    $registro->igv=$_POST['igv'];
    $registro->total=$_POST['total'];
    $registro->usuario=$usuario;
    $miscompras = $registro->registro();
    $_SESSION['numero_compra'] = $miscompras[1];

    $articulo = $_POST['articulo_'];
    $unidad = $_POST['unidad'];
    $cantidadProducto = $_POST['cantidadProducto_'];
    $cantidad_unidad = $_POST['cantidad_unidad'];
    $factura = $_POST['factura_'];
    $precioProducto = $_POST['precioProducto_'];
    $proveedor = $_POST['proveedor_'];
    $tipocompra = $_POST['tipocompra_'];
    $adelanto = $_POST['adelanto_'];
    $almacen = $_POST['almacen_'];
    for ($i=0; $i < count($articulo) ; $i++) { 
        $registro1 = new ProcesoData();
        $registro1->proveedor = $proveedor[$i];
        $registro1->numerofacfoli = $factura[$i];
        $registro1->almacen = $almacen[$i];
        $registro1->unidad = $unidad[$i];
        $registro1->tipocompra = $tipocompra[$i];
        $registro1->articulo = $articulo[$i];
        $registro1->cantidad = $cantidadProducto[$i]*$cantidad_unidad[$i];
        $registro1->precio = $precioProducto[$i];
        $registro1->adelanto = $adelanto[$i];
        $registro1->compra = $miscompras[1];
        $registro1->usuario = $usuario;
        // $registro1->total = $cantidadProducto[$i] * $precioProducto[$i];
        if ($tipocompra[$i]=="contado") {
            $registro1->estado = 0;
        }
        if ($tipocompra[$i]=="credito") {
            $registro1->estado = 1;
        }
        $registro1->compra();
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: compra");
}
if ($actions==23) {
    $usuario=$_SESSION['conticomtc'];
    $registro = new VentaData();
    $registro->subtotal=$_POST['subtotal'];
    $registro->descuento=$_POST['descuento'];
    $registro->igv=$_POST['igv'];
    $registro->total=$_POST['total'];
    // $registro->tipoventa=$_POST['tipoventa'];
    if ($_POST['tipoventa']=="contado") {
        $registro->tipoventa=1;
    }
    if ($_POST['tipoventa']=="credito") {
        $registro->tipoventa=2;
    }
    if ($_POST['tipoventa']=="contado") {
        $registro->estado = 2;
    }
    if ($_POST['tipoventa']=="credito") {
        $registro->estado = 1;
    }
    
    $registro->adelanto=$_POST['adelanto'];
    $registro->comprobante=$_POST['comprobante'];
    $registro->accion=$_POST['accion'];
    $registro->factura=$_POST['factura'];
    $registro->cliente=$_POST['cliente'];
    $registro->descripcion=$_POST['descripcion'];
    $registro->usuario=$usuario;
    $misventas = $registro->registro();
    $_SESSION['numero_compra'] = $misventas[1];

    $articulo = $_POST['articulo_'];
    $unidad = $_POST['unidad_'];
    $cantidadProducto = $_POST['cantidadProducto_'];
    $cantidad_unidad = $_POST['cantidad_unidad_'];
    $precioProducto = $_POST['precioProducto_'];
    $precio_unidad = $_POST['precio_unidad_'];
    $cantidad = $_POST['cantidad_'];
    $almacen = $_POST['almacen_'];

    for ($i=0; $i < count($articulo) ; $i++) { 
        $registro1 = new ProcesoData();
        $registro1->almacen = $almacen[$i];
        $registro1->unidad = $unidad[$i];
        $registro1->articulo = $articulo[$i];
        $registro1->cantidad = $cantidadProducto[$i]*$cantidad_unidad[$i];
        $registro1->precio = $precioProducto[$i];
        $registro1->venta = $misventas[1];
        $registro1->usuario = $usuario;
        // $registro1->total = $cantidadProducto[$i] * $precioProducto[$i];
        $registro1->venta();
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: venta");
}
if ($actions==24) {
    try {
        $mysqli->begin_transaction();
        $venta = VentaData::verid($_POST["id"]);
        $procesos = ProcesoData::verventa($venta->id);
        foreach ($procesos as $proceso) {
            $eliminar = ProcesoData::verid($proceso->id);
            $eliminar->eliminar();
            echo $proceso->id;
        }
        $venta->eliminar();
        $mysqli->commit();

        $_SESSION['eliminado'] = "Eliminado con éxito.";
    } catch (Exception $e) {
        $mysqli->rollback();
        $_SESSION['eliminado'] = "No se puede eliminar este registro debido a relaciones en otras tablas.";
    }
    header("Location: cotizacion");
}
if ($actions==25) {
    $registro = new VentaData();
    $registro->id=$_POST['id'];
    $registro->accion=1;
    $registro->cotizacion_venta();
    // $datos = ProcesoData::verventa($_POST['id']);
    // foreach ($datos as $dato) {
    //     echo $dato->id;
    //     // code...
    // }
    $_SESSION['success_messagea'] = "Cotización validad como una venta con éxito";
    header("Location: cotizacion");
}
if ($actions==26) {
    $abono = $_POST['adelantito'];
    $montoabonando = $_POST['adelanto'];
    $debecancelar = $_POST['precio'];
    $registro = new ProcesoData();
    $registro->adelanto=$montoabonando+$abono;
    if ($montoabonando+$abono>=$debecancelar) {
        $registro->estado=2;
    } else {
        $registro->estado=1;
    }
    $registro->id=$_POST['id'];
    $registro->validandocomprasporpagar();
    $_SESSION['success_messagea'] = "Registro del abono con éxito";
    header("Location: comprapendiente");
}
if ($actions==27) {
    $abono = $_POST['adelantito'];
    $montoabonando = $_POST['adelanto'];
    $debecancelar = $_POST['precio'];
    $registro = new VentaData();
    $registro->adelanto=$montoabonando+$abono;
    if ($montoabonando+$abono>=$debecancelar) {
        $registro->estado=2;
    } else {
        $registro->estado=1;
    }
    $registro->id=$_POST['id'];
    $registro->validarventaporcobrar();
    $_SESSION['success_messagea'] = "Registro del abono con éxito";
    header("Location: ventapendiente");
}
if ($actions==28) {
    $duplicidad=$_POST['nombre'];
    $c = UnidadData::duplicidadd($duplicidad);
        if ($c == null) {
           $registro = new UnidadData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: unidad");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: unidad");
        }
}
if ($actions==29) {
    $duplicidad=$_POST['nombre'];
    $registro = new UnidadData();
    foreach ($_POST as $k => $v) {
        if (property_exists($registro, $k)) {
            $registro->$k = $v;
        }
    }
    $registro->duplicidad=$duplicidad;
    if (UnidadData::evitarladuplicidad($duplicidad, $_POST['id'])) {
        $_SESSION['success_messagea1'] = "Ya existe en otro registro similar.";
        header("Location: unidad");
        exit;
    }
    $registro->actualizar();
    $_SESSION['success_messagea'] = "Actualizado con éxito.";
    header("Location: unidad");
}
if ($actions==30) {
    try {
            $mysqli->begin_transaction();
            $eliminar = UnidadData::verid($_POST["id"]);
            $eliminar->eliminar();
            $mysqli->commit();

            $_SESSION['eliminado'] = "Eliminado con éxito.";
        } catch (mysqli_sql_exception $e) {
            $_SESSION['eliminado'] = "No se puede eliminar este usuario debido a relaciones en otras tablas.";
        }
        header("Location: unidad");
}
if ($actions==31) {
    $duplicidad = $_POST['precio'].$_POST['articulo'].$_POST['tipo'].$_POST['unidad'];
    $c = PrecioData::duplicidadd($duplicidad);
        if ($c == null) {
           $registro = new PrecioData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        if ($_POST['precioc1']=="") {
            $registro->precioc=$_POST['precioc2'];
        } else {
            $registro->precioc=$_POST['precioc1'];
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: articulo");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: articulo");
        }
}







if ($actions==37) {
    $duplicidad = $_POST['precio'].$_POST['producto'].$_POST['tipo'].$_POST['presentacion'];
    $c = PrecioData::duplicidadd($duplicidad);
        if ($c == null) {
           $registro = new PrecioData();
        foreach ($_POST as $K => $v){
            if (property_exists($registro, $K)) {
                $registro->$K = $v;
            }
        }
        $registro->duplicidad=$duplicidad;
        $registro->registro();
        $_SESSION['success_message'] = "El registro se completó con éxito.";
        header("Location: producto");
        } else {
            $_SESSION['error_message'] = "Ya existe el registro...!";
            header("Location: producto");
        }
}
if ($actions==38) {
    $usuario = $_SESSION['conticomtc'];

// Registrar una nueva compra
    $registro = new CompraData();
    $registro->iva = $_POST['iva'];
    $registro->subtotal = $_POST['subtotal'];
    $registro->descuento = $_POST['descuento'];
    $registro->total = $_POST['total'];
    $registro->precio = $_POST['precio'];
    $registro->moneda = $_POST['moneda'];
    $registro->descripcion = $_POST['descripcion'];
    $registro->usuario = $usuario;
    $cmpr = $registro->registro();
    $_SESSION['numero_compra'] = $cmpr[1];

// Datos del producto
    $producto = $_POST['producto_'];
    $presentaciones = $_POST['presentacion_'];
    $cantidad = $_POST['cantidadProducto_'];
    $precio = $_POST['precioProducto_'];
    $sucursal = $_POST['sucursal'];
    $almacen = $_POST['almacen'];
    $proveedor = $_POST['proveedor_'];
    $barcodes = $_POST['barcode_'];
    $imeis = $_POST['imei_'];
    $producto_num = $_POST['producto_num_'];
    $categoria = $_POST['categoria_'];
    $tipo_producto = $_POST['tipo_producto_'];

// Datos adicionales
    $marca = $_POST['marca_'];
    $serie = $_POST['serie_'];
    $modelo = $_POST['modelo_'];
    $vencimiento = $_POST['vencimiento_'];
    $minimo = $_POST['minimo_'];
    $color = $_POST['color_'];
    $talla = $_POST['talla_'];
    $estado = $_POST['estado_'];
    $isnuevo = $_POST['isnuevo'];
    $repetible_checkboxes = $_POST['repetible_checkbox'];

    for ($index = 0; $index < count($categoria); $index++) {

        if ($isnuevo[$index]=="1") {

            $c = ProductoData::duplicidadd($imeis[$index]);
            if ($c == null) {
                $registro2 = new ProductoData();
                $registro2->nombre = $producto_num[$index];
                $registro2->categoria = $categoria[$index];
                $registro2->precio = $precio[$index];
                $registro2->tipo_producto = $tipo_producto[$index];
                $registro2->sucursal = $sucursal;
                $registro2->barcode = $barcodes[$index];
                $registro2->imei = $imeis[$index];
                $registro2->marca = $marca[$index];
                $registro2->serie = $serie[$index];
                $registro2->modelo = $modelo[$index];
                $registro2->vencimiento = $vencimiento[$index];
                $registro2->minimo = $minimo[$index];
                $registro2->color = $color[$index];
                $registro2->talla = $talla[$index];
                $registro2->estado = $estado[$index];

                $product1 = $registro2->registro_compra();

                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $product1[1];
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();

            } else {
                // $id=$c[0]->id;
                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $c[0]->id;
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();
            }
        }
        if ($producto[$index]!="") {
            $registroDetalle = new DetalleCompraData();
            $registroDetalle->producto = $producto[$index];
            $registroDetalle->cantidad = $cantidad[$index];
            $registroDetalle->precio = $precio[$index];
            $registroDetalle->sucursal = $sucursal;
            $registroDetalle->almacen = $almacen;
            $registroDetalle->proveedor = $proveedor[$index];
            $registroDetalle->compra = $cmpr[1];
            $registroDetalle->registro();
        }
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: compra");
}
if ($actions==139) {
    $usuario = $_SESSION['conticomtc'];
    $sucursal = $_POST['sucursal'];

// Registrar una nueva compra
    $registro = new CompraData();
    $registro->iva = $_POST['iva'];
    $registro->subtotal = $_POST['subtotal'];
    $registro->descuento = $_POST['descuento'];
    $registro->total = $_POST['total'];
    $registro->precio = $_POST['precio'];
    // $registro->moneda = $_POST['moneda'];
    $registro->sucursal = $sucursal;
    $registro->descripcion = $_POST['descripcion'];
    $registro->recibidor = $_POST['recibidor'];
    $registro->tipocompra=$_POST['tipocompra'];
    $registro->adelanto=$_POST['adelanto'];
    $registro->restante=$_POST['restante'];
    $registro->usuario = $usuario;
    $cmpr = $registro->registro();
    $_SESSION['numero_compra'] = $cmpr[1];

// Datos del producto
    $producto = $_POST['producto_'];
    $presentaciones = $_POST['presentacion_'];
    $cantidad = $_POST['cantidadProducto_'];
    $precio = $_POST['precioProducto_'];
    $almacen = $_POST['almacen'];

    $proveedor = $_POST['proveedor_'];
    $imeis = $_POST['imei_'];
    $producto_num = $_POST['producto_num_'];
    $tipo_producto = $_POST['tipo_producto_'];
    $capacidad = $_POST['capacidad_'];
    $color = $_POST['color_'];
    $serie = $_POST['serie_'];
    $moneda = $_POST['moneda_'];

// Datos adicionales

    $isnuevo = $_POST['isnuevo'];
    // $repetible_checkboxes = $_POST['repetible_checkbox'];

    for ($index = 0; $index < count($tipo_producto); $index++) {

        if ($isnuevo[$index]=="1") {

            $c = ProductoData::duplicidadd($imeis[$index]);
            if ($c == null) {
                $registro2 = new ProductoData();
                $registro2->nombre = $producto_num[$index];
                $registro2->tipo_producto = $tipo_producto[$index];
                $registro2->sucursal = $sucursal;
                $registro2->imei = $imeis[$index];
                $registro2->capacidad = $capacidad[$index];
                $registro2->color = $color[$index];
                $registro2->serie = $serie[$index];
                $product1 = $registro2->registro_compra1();

                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $product1[1];
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();

                $precios1 = new PrecioData();
                $precios1->producto = $product1[1];
                $precios1->cantidad = $cantidad[$index];
                $precios1->moneda = $moneda[$index];
                $precios1->duplicidad = $sucursal.$product1[1].$precio[$index];
                $precios1->presentacion=$presentaciones[$index];
                $precios1->precioc = $precio[$index];
                $precios1->compra();

            } else {
                // $id=$c[0]->id;
                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $c[0]->id;
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();

                $precios2 = new PrecioData();
                $precios2->producto = $c[0]->id;
                $precios2->cantidad = $cantidad[$index];
                $precios2->moneda = $moneda[$index];
                $precios2->duplicidad = $sucursal.$c[0]->id.$precio[$index];
                $precios2->presentacion=$presentaciones[$index];
                $precios2->precioc = $precio[$index];
                $precios2->compra();
            }
        }
        if ($producto[$index]!="") {
            $registroDetalle = new DetalleCompraData();
            $registroDetalle->producto = $producto[$index];
            $registroDetalle->cantidad = $cantidad[$index];
            $registroDetalle->precio = $precio[$index];
            $registroDetalle->sucursal = $sucursal;
            $registroDetalle->almacen = $almacen;
            $registroDetalle->proveedor = $proveedor[$index];
            $registroDetalle->compra = $cmpr[1];
            $registroDetalle->registro();

            $actualizar = new ProductoData();
            $actualizar->serie = $serie[$index];
            $actualizar->id = $producto[$index];
            $actualizar->actualizarserie();

            $precios3 = new PrecioData();
            $precios3->producto = $producto[$index];
            $precios3->cantidad = $cantidad[$index];
            $precios3->moneda = $moneda[$index];
            $precios3->duplicidad = $sucursal.$producto[$index].$precio[$index];
            $precios3->presentacion=$presentaciones[$index];
            $precios3->precioc = $precio[$index];
            $precios3->compra();

        }
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: compra");
}
if ($actions==39) {
    $usuario = $_SESSION['conticomtc'];
    $sucursal = $_POST['sucursal'];

// Registrar una nueva compra
    $registro = new CompraData();
    $registro->iva = $_POST['iva'];
    $registro->subtotal = $_POST['subtotal'];
    $registro->descuento = $_POST['descuento'];
    $registro->total = $_POST['total'];
    $registro->precio = $_POST['precio'];
    // $registro->moneda = $_POST['moneda'];
    $registro->sucursal = $sucursal;
    $registro->descripcion = $_POST['descripcion'];
    $registro->recibidor = $_POST['recibidor'];
    $registro->tipocompra=$_POST['tipocompra'];
    $registro->adelanto=$_POST['adelanto'];
    $registro->restante=$_POST['restante'];
    $registro->usuario = $usuario;
    $cmpr = $registro->registro();
    $_SESSION['numero_compra'] = $cmpr[1];

// Datos del producto
    $producto = $_POST['producto_'];
    $presentaciones = 1;
    $cantidad = $_POST['cantidadProducto_'];
    $precio = $_POST['precioProducto_'];
    $almacen = $_POST['almacen'];

    $proveedor = $_POST['proveedor_'];
    $imeis = $_POST['imei_'];
    $producto_num = $_POST['producto_num_'];
    $tipo_producto = $_POST['tipo_producto_'];
    $capacidad = $_POST['capacidad_'];
    $color = $_POST['color_'];
    $serie = $_POST['serie_'];
    $moneda = $_POST['moneda_'];

// Datos adicionales

    $isnuevo = $_POST['isnuevo'];
    // $repetible_checkboxes = $_POST['repetible_checkbox'];

    for ($index = 0; $index < count($tipo_producto); $index++) {

        if ($isnuevo[$index]=="1") {

            $c = ProductoData::duplicidadd($imeis[$index]);
            if ($c == null) {
                $registro2 = new ProductoData();
                $registro2->nombre = $producto_num[$index];
                $registro2->tipo_producto = $tipo_producto[$index];
                $registro2->sucursal = $sucursal;
                $registro2->imei = $imeis[$index];
                $registro2->capacidad = $capacidad[$index];
                $registro2->color = $color[$index];
                $registro2->serie = $serie[$index];
                $product1 = $registro2->registro_compra1();

                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $product1[1];
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();

                $precios1 = new PrecioData();
                $precios1->producto = $product1[1];
                $precios1->cantidad = $cantidad[$index];
                $precios1->moneda = $moneda[$index];
                $precios1->duplicidad = $sucursal.$product1[1].$precio[$index];
                $precios1->presentacion=$presentaciones;
                $precios1->precioc = $precio[$index];
                $precios1->compra();

            } else {
                // $id=$c[0]->id;
                $registroDetalle = new DetalleCompraData();
                $registroDetalle->producto = $c[0]->id;
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->almacen = $almacen;
                $registroDetalle->proveedor = $proveedor[$index];
                $registroDetalle->compra = $cmpr[1];
                $registroDetalle->registro();

                $precios2 = new PrecioData();
                $precios2->producto = $c[0]->id;
                $precios2->cantidad = $cantidad[$index];
                $precios2->moneda = $moneda[$index];
                $precios2->duplicidad = $sucursal.$c[0]->id.$precio[$index];
                $precios2->presentacion=$presentaciones;
                $precios2->precioc = $precio[$index];
                $precios2->compra();
            }
        }
        if ($producto[$index]!="") {
            $registroDetalle = new DetalleCompraData();
            $registroDetalle->producto = $producto[$index];
            $registroDetalle->cantidad = $cantidad[$index];
            $registroDetalle->precio = $precio[$index];
            $registroDetalle->sucursal = $sucursal;
            $registroDetalle->almacen = $almacen;
            $registroDetalle->proveedor = $proveedor[$index];
            $registroDetalle->compra = $cmpr[1];
            $registroDetalle->registro();

            $actualizar = new ProductoData();
            $actualizar->serie = $serie[$index];
            $actualizar->id = $producto[$index];
            $actualizar->actualizarserie();

            $precios3 = new PrecioData();
            $precios3->producto = $producto[$index];
            $precios3->cantidad = $cantidad[$index];
            $precios3->moneda = $moneda[$index];
            $precios3->duplicidad = $sucursal.$producto[$index].$precio[$index];
            $precios3->presentacion=$presentaciones;
            $precios3->precioc = $precio[$index];
            $precios3->compra();

        }
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: compra");
}
if ($actions==40) {
    $usuario = $_SESSION['conticomtc'];
    $sucursal = $_POST['sucursal'];

// Registrar una nueva compra
    $registro = new VentaData();
    $registro->iva = $_POST['iva'];
    $registro->subtotal = $_POST['subtotal'];
    $registro->descuento = $_POST['descuento'];
    $registro->total = $_POST['total'];
    $registro->sucursal = $sucursal;
    $registro->descripcion = $_POST['descripcion'];
    $registro->cliente = $_POST['recibidor'];
    $registro->tipo_venta=$_POST['tipocompra'];
    $registro->adelanto=$_POST['adelanto'];
    $registro->restante=$_POST['restante'];
    $registro->usuario = $usuario;
    $cmpr = $registro->registro();
    $_SESSION['numero_venta'] = $cmpr[1];

// Datos del producto
    $producto = $_POST['producto_'];
    $cantidad = $_POST['cantidadProducto_'];
    $precio = $_POST['precioProducto_'];
    $almacen = $_POST['stock_'];

    $imeis = $_POST['imei_'];
    $detalle = $_POST['detalle_'];
    $articulo_num = $_POST['articulo_num_'];
    // $color = $_POST['color_'];
    // $serie = $_POST['serie_'];
    $moneda = $_POST['moneda_'];
    $proveedor = $_POST['proveedor_'];

// Datos adicionales

    $isnuevo = $_POST['isnuevo'];
    // $repetible_checkboxes = $_POST['repetible_checkbox'];

    for ($index = 0; $index < count($precio); $index++) {

        if ($isnuevo[$index]=="1") {

            $registro2 = new ProductoExternoData();
                $registro2->venta = $cmpr[1];
                $registro2->nombre = $producto[$index];
                // $registro2->detalle = $capacidad[$index].", ".$imeis[$index].", ".$color[$index].", ".$serie[$index];
                $registro2->detalle = $detalle[$index];
                $registro2->cantidad = $cantidad[$index];
                $registro2->precio = $precio[$index];
                $registro2->usuario = $usuario;
                $registro2->proveedor = $proveedor[$index];
                $product11 = $registro2->registro();

                $registroDetalle = new DetalleVentaData();
                $registroDetalle->producto1 = $product11[1];
                $registroDetalle->cantidad = $cantidad[$index];
                $registroDetalle->precio = $precio[$index];
                $registroDetalle->sucursal = $sucursal;
                $registroDetalle->venta = $cmpr[1];
                $registroDetalle->registro();
        }
        if ($articulo_num[$index]!="") {
            $registroDetalle = new DetalleVentaData();
            $registroDetalle->producto = $articulo_num[$index];
            $registroDetalle->cantidad = $cantidad[$index];
            $registroDetalle->precio = $precio[$index];
            $registroDetalle->sucursal = $sucursal;
            $registroDetalle->almacen = $almacen[$index];
            $registroDetalle->venta = $cmpr[1];
            $registroDetalle->registro1();

        }
    }
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    $_SESSION['show_modal'] = true;
    $_SESSION['success_message'] = "El registro se completó con éxito.";
    header("Location: venta");
}
?>