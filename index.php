<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "INICIANDO SITE...<br>";

include('app/db_configuracao/dbconfig.php');
include('app/db_configuracao/tabelas.php');
include('app/db_configuracao/cobranca.php');

$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);

$url = (isset($_GET['url'])) ? $_GET['url'] : 'index';
$url = array_filter(explode('/', $url));

$file = 'app/php/' . $url[0] . '.php';

if (is_file($file)) {
    echo "Incluindo: $file<br>";
    include $file;
} else {
    echo "Arquivo não encontrado: $file<br>";
    include '404.php';
}

include('cobranca.php');
?>
