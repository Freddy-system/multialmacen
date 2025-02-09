<?php 
if ($action == 'deleteprecio') {
    $rowId = intval($_POST['id']);
    
    $precio = PrecioData::verid($rowId);
    if ($precio) {
        $precio->eliminar(); // Suponiendo que tienes un método 'eliminar' en tu clase PrecioData.
        
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registro no encontrado.']);
    }
} ?>