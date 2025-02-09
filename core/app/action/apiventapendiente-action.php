<?php 
if ($_GET['action'] == 'apiventapendiente') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = VentaData::vercontenidoPaginado2($start, $length, $search);
    $totalRegistros = VentaData::totalRegistro2();
    $totalRegistrosFiltrados = VentaData::totalRegistrosFiltrados2($search);
    
    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
} ?>