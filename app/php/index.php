<?php
session_start();

include('app/helpers/produtos/class.itens.php');
$object_catpizza = new produtos;
$object_catpizza->catPizza();

require_once 'app/layout/'.$resultado_templete_i['templete'].'/index.php';
?>