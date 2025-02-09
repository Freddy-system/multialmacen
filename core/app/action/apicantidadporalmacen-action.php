<?php 
if ($_GET['action'] == 'apicantidadporalmacen') {
    $productoId = $_GET['producto_id'];
    $resultados = ProcesoData::cantidadporalmacen($productoId);
    echo json_encode($resultados);
    exit;
} ?>