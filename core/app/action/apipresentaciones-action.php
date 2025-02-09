<?php
if ($_GET['action'] == 'apipresentaciones') {
    $presentacion = UnidadData::vercontenido();
    echo json_encode($presentacion);
    exit;
} ?>