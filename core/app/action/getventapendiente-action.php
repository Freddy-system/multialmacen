<?php if ($_GET['action'] == 'getventapendiente') {
    $id = $_GET['id'];
    $cargos = VentaData::verid($id);
    echo json_encode($cargos);
    exit;
} ?>