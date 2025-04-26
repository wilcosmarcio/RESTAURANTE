<?php include('app/php/autoload.php');?>
<?php
$object_catpizza->catPizza();

//protecao login
if($validacao == 'ok'){
    if($url[0] == "dashboard"){
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/dashboard/index.php';
        }
    }
}
//redireciona se o login nao estiver efetuado
if($validacao == 'false'){
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
}
?>