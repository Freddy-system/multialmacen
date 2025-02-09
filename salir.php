<?php
session_start();
if(isset($_SESSION['user_id'])){
	unset($_SESSION['user_id']);
}
if(isset($_SESSION['tsistema'])){
	unset($_SESSION['tsistema']);
}
session_destroy();
print "<script>window.location='./';</script>";
?>