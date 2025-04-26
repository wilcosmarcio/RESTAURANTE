<?php include('app/php/autoload.php');?>
<?php
include('app/helpers/class.faixacep/class.faixacep.php');
$obj_faixacep = new FaixaCep;
session_start();
//protecao login
if($validacao == 'ok'){
    if($url[0] == "FaixaCep"){
        if($url[1] == "listagem"){
            $obj_faixacep->ListagemAdministrativo();
        }
    }
}

//redireciona se o login nao estiver efetuado
if($validacao == 'false'){
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
}