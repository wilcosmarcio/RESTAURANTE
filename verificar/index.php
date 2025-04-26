<?php session_start();?>
<?php include('../app/db_configuracao/dbconfig.php'); include('../app/db_configuracao/tabelas.php'); ?>
<?php
if(isset($_POST['btn_logar'])){
    if($_POST['conectado'] == ''){
        include('session.php');
    } else {
        include('cookie.php');
    }
}
?>