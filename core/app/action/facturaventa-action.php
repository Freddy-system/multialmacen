<?php
require_once('tcpdf/tcpdf.php');
$ventas = VentaData::verid($_GET['tid']);
$datas = ProcesoData::vercontenidos1($ventas->id);
?>