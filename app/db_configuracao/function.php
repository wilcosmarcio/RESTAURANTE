<?php

include('db_configuracao/dbconfig.php');
function session_checker(){

if (!isset($_SESSION['usuario_id'])){
error_reporting(0);
ini_set(“display_errors”, 0 );
header ("Location:index.php");
exit();

}

}

?>