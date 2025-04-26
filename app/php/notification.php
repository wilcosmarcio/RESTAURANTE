<?php include('app/php/autoload.php');?>
<?php
include('app/db_configuracao/tabelas.php');
if($url[0] == "notification"){
    $obj_mensalidade->notification();
}
?>