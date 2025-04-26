<?php
session_start();
if($url[0] == "pedidos"){
    require_once 'app/layout/'.$resultado_templete_i['templete'].'/pedidos/index.php';
}
?>