<?php session_start(); ?>
<?php
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');
// Conexão com banco de dados
$servername = "localhost";
$username   = "";
$password   = "";
$db_name    = "";

$conexao = mysqli_connect($servername, $username, $password, $db_name);
?>