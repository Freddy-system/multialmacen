<?php 
if ($_GET['action'] == 'apiprecio') {
    $articulo = $_GET['articulo'];
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = PrecioData::vercontenidoPaginado($start, $length, $articulo, $search);
    $totalRegistros = PrecioData::totalRegistro();
    $totalRegistrosFiltrados = PrecioData::totalRegistrosFiltrados($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>