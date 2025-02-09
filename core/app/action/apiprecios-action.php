<?php
if(isset($_POST["id_producto"]) && !empty($_POST["id_producto"])){
    $producto = $_POST["id_producto"];
    $precios = PrecioData::vercontenidoporprodcuto($producto);
    
    foreach($precios as $precio) {
    echo "<option value='".$precio->id."' data-cantidad='".$precio->cantidad."' data-precio='".$precio->precio."'>".$precio->presentaciones."</option>";
    }
} ?>