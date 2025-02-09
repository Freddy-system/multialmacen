<?php 
if ($_GET['action'] == 'apiinventario') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = ArticuloData::vercontenidoPaginado1($start, $length, $search);
    $totalRegistros = ArticuloData::totalRegistro1();
    $totalRegistrosFiltrados = ArticuloData::totalRegistrosFiltrados1($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>