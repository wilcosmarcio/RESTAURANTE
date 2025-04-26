<?php include('app/php/autoload.php');?>
<?php
//protecao login
if($validacao == 'ok'){
    $obj_comandas->listagem();
}
//redireciona se o login nao estiver efetuado
if($validacao == 'false'){
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
}
?>