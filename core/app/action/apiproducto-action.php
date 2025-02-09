<?php 
if ($_GET['action'] == 'apiproducto') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = ArticuloData::vercontenidoPaginado($start, $length, $search);
    $totalRegistros = ArticuloData::totalRegistro();
    $totalRegistrosFiltrados = ArticuloData::totalRegistrosFiltrados($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>