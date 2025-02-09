<?php 
if ($_GET['action'] == 'apimcompra') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = CompraData::vercontenidoPaginado($start, $length, $search);
    $totalRegistros = CompraData::totalRegistro();
    $totalRegistrosFiltrados = CompraData::totalRegistrosFiltrados($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>