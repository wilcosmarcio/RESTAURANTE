<?php

ini_set('display_errors', 0 );
error_reporting(0);

?>
<?php include('app/db_configuracao/tabelas.php');?>
<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	session_start();
	echo "<center><h5>Carregando...</h5></center>";
	$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	echo "<script> window.location.href='http://".$host."/".$resultado_painel['painel']."'; </script>";
?>