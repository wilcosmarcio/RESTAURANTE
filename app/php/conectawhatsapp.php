<?php
//whatsapp
include('app/helpers/classes/whatsapp/class.whatsapp.php');
$obj_whatsapp = new whatsapp;

//protecao login
if($validacao == 'ok'){
    if($url[0] == "conectawhatsapp"){
        $obj_whatsapp->auth();
    }
}