<?php if ($_GET['action'] == 'getventa') {
    $id = $_GET['id'];
    $datos = VentaData::verid($id);
    echo json_encode($datos);
    exit;
} ?>