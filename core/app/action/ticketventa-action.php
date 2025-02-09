<?php
function formato_soles($monto) {
    $simbolo_moneda = "$ ";
    if ($monto !== null) {
        $monto_formateado = number_format($monto, 2, '.', ',');
        $monto_formateado = $simbolo_moneda . $monto_formateado;
        return $monto_formateado;
    } else {
        return "0"; 
    }
}
$totalf=0;
$totalcant=0;
ini_set('display_errors', 0);
error_reporting(0);
ob_start();
$ventas = VentaData::verid($_GET['tid']);

require_once('tcpdf/tcpdf.php'); 

$pdf = new TCPDF('P', 'mm', array(72, 200), true, 'UTF-8', false); 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Ticket de Venta');
$pdf->SetSubject('Ticket');
$pdf->SetKeywords('TCPDF, PDF, ticket, test');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 5, 5);
$pdf->AddPage();
// $image_file = 'storage/per/logo.png';
// $pdf->Image($image_file, 50, 2, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
// $pdf->SetY(5);
$pdf->SetFont('helvetica', 'B', 13);

$html = '<h2 style="color: #333333; text-align: center;">MM&M</h2>';
$html .= '<p style="color: #555555; text-align: center;"><b>MULTIMADERAS Y MOLDURAS</b></p>';

$html .= '<p style="color: #555555;">CARRETERA FEDERAL KM 12<br>CANDELARIA PORTEZUELO<br>24912224424<br><br><b>CLIENTE: </b>:  '.$ventas->clientes.'<b><br>FORMA DE PAGO</b>:  ';

switch ($ventas->tipoventa) {
    case 1:
        $html .= 'Efectivo';
        break;
    case 2:
        $html .= 'Crédito';
        break;
    case 3:
        $html .= 'Depósito';
        break;
    default:
        // En caso de que el tipo de venta no sea 1, 2 o 3, aquí puedes manejar otro caso si es necesario
        break;
}
$html .= '<br><b>ESTADO: </b>:  '.($ventas->estado ? "Pagado" : "Pago Incompleto").'<br><br><b>FECHA DE PAGO</b>:  '.$ventas->fecha.'<br><b>RECIBO Nº '.$ventas->id.'</b></p>';

$pdf->SetFont('helvetica', '', 8);
$html .= '<style>
            th {
                background-color: #f5f5f5;
                font-weight: bold;
                color: #333333;
                border-bottom: 1px solid #ddd;
            }
            td, th {
                padding: 8px 5px;
                color: #555555;
            }
            table {
                border-collapse: collapse;
            }
        </style>';
$pdf->SetFont('helvetica', '', 6);
$html .= '<table border="0" cellpadding="2" width="100%">';

$html .= '<thead>';
$html .= '<tr>';
$html .= '<th width="55%"><b>Producto</b></th>'; 
$html .= '<th width="25%"><b>Cant.</b></th>';
$html .= '<th width="20%"><b>Precio</b></th>';
$html .= '</tr>';
$html .= '</thead>';

$datas = ProcesoData::vercontenidos1($ventas->id);
foreach ($datas as $data) {
    $totalf += $data->cantidad * $data->precio;
    $totalcant += $data->cantidad;
    $html .= '<tr>';
    $html .= '<td width="55%" style="font-size: 5px;">' . $data->articulos . '</td>';
    $html .= '<td width="25%" style="font-size: 5px;">'. $data->cantidad/$data->cantidad_unidad . ' '.$data->unidades .'</td>';
    $html .= '<td width="20%" style="font-size: 5px;">' . formato_soles($data->precio) . '</td>';
    $html .= '</tr>';
}

$html .= '<tfoot>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>SUBTOTAL</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->subtotal).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>DESCUENTO</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->descuento).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>IMPUESTOS</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->igv).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>GRAND TOTAL</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->total).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>SALDO PENDIENTE</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->adelanto).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>SU PAGO</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->total).'</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" style="border-top: 1px solid #ddd;"><b>NUEVO SALDO PENDIENTE</b></td>';
$html .= '<td  style="border-top: 1px solid #ddd;"><b>'.formato_soles($ventas->adelanto).'</b></td>';
$html .= '</tr>';
$html .= '</tfoot>';
$html .= '<p style="color: #000000;"><b>Cajero: </b>'.$ventas->responsable.'  <br> MUCHAS GRACIAS POR SU PREFERENCIA</p>';
$html .= '<div style="margin-top: 1px;"></div>'; 
$html .= '<div style="border-top: 1px dashed #000;"></div>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('ticket.pdf', 'I'); 
ob_end_flush(); 
?>