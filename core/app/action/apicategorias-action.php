<?php
if ($_GET['action'] == 'apicategorias') {
    $datos = CategoriaData::vercontenido();
    echo json_encode($datos);
    exit;
} ?>