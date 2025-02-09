<?php 
if ($_GET['action'] == 'apicotizacion') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = VentaData::vercontenidoPaginado1($start, $length, $search);
    $totalRegistros = VentaData::totalRegistro1();
    $totalRegistrosFiltrados = VentaData::totalRegistrosFiltrados1($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>