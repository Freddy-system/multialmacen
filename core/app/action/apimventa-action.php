<?php 
if ($_GET['action'] == 'apimventa') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = VentaData::vercontenidoPaginado($start, $length, $search);
    $totalRegistros = VentaData::totalRegistro();
    $totalRegistrosFiltrados = VentaData::totalRegistrosFiltrados($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>