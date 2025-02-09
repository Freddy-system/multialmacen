<?php
session_start();
$codigoIngresado = $_POST['codigo'];
if(!isset($_COOKIE['verificationCode'])) {
    $_SESSION['error_message1'] = "El tiempo para validar el código ha expirado.";
    header("Location: index.php?view=login");
    exit;
}
if($codigoIngresado != $_COOKIE['verificationCode']) {
    $_SESSION['error_message1'] = "El código ingresado es incorrecto. Intente nuevamente.";
    header("Location: index.php?view=login");
    exit;
}
$_SESSION['conticomtc'] = $_COOKIE['posiblesesion'];
header("Location: index.php?view=index");
exit;
?>
