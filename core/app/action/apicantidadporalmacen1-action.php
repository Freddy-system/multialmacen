<?php 
if ($_GET['action'] == 'apicantidadporalmacen1') {
    $productoId = $_GET['producto_id'];
    $resultados = ProcesoData::cantidadporalmacen($productoId);
    header('Content-Type: application/json');
    echo json_encode($resultados);
    exit;
} ?>