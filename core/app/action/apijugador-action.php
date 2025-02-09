<?php 
if ($_GET['action'] == 'apijugador') {
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    $search = $_REQUEST['search']['value'];
    
    $contenidoporpagina = JugadorData::vercontenidoPaginado($start, $length, $search);
    $totalRegistros = JugadorData::totalRegistro();
    $totalRegistrosFiltrados = JugadorData::totalRegistrosFiltrados($search);

    $response = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalRegistros,
        "recordsFiltered" => $totalRegistrosFiltrados,
        "data" => $contenidoporpagina
    );
    
    echo json_encode($response);
    exit;
}

 ?>