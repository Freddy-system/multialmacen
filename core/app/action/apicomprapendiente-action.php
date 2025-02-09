<?php 
if ($_GET['action'] == 'apicomprapendiente') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = ProcesoData::vercontenidoPaginado1($start, $length, $search);
    $totalRegistros = ProcesoData::totalRegistro1();
    $totalRegistrosFiltrados = ProcesoData::totalRegistrosFiltrados1($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>