<?php
if ($_GET['action'] == 'apiprecioscompra') {
    $articulo = $_GET['articulo'];
    $datos = ProcesoData::vercontenidoprecio($articulo);
    echo json_encode($datos);
    exit;
} ?>