<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'updateprecio') {
    $columnName = $_POST['column'];
    $rowId = intval($_POST['id']);
    $value = $_POST['value'];
    $validColumns = ["producto", "cantidad", "tipo", "precio", "comision", "estado", "duplicidad", "unidad"];
    if (!in_array($columnName, $validColumns)) {
        die(json_encode(['status' => 'error', 'message' => 'Nombre de columna no válido.']));
    }
    $precio = PrecioData::verid($rowId); 
    if ($precio) {
        $precio->$columnName = $value;
        $precio->actualizar();
        
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registro no encontrado.']);
    }
}
?>
