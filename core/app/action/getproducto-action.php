<?php if ($_GET['action'] == 'getproducto') {
    $id = $_GET['id'];
    $datos = ArticuloData::verid($id);
    echo json_encode($datos);
    exit;
} ?>