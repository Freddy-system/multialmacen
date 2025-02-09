<?php if ($_GET['action'] == 'getcomprapendiente') {
    $id = $_GET['id'];
    $cargos = ProcesoData::verid($id);
    echo json_encode($cargos);
    exit;
} ?>