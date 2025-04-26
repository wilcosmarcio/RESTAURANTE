<?php include('app/php/autoload.php');?>
<?php
if($validacao == 'ok'){
    include('app/db_configuracao/tabelas.php');
    if($url[0] == "plano"){
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/plano/index.php';
        }
        if($url[1] == "renovar"){
            $total_sem_desconto = $resultado_dados['valor_mensal'];
            $total_5    = $total_sem_desconto - ($total_sem_desconto / 100) * 5;
            $total_10   = $total_sem_desconto - ($total_sem_desconto / 100) * 10;
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/plano/renovar.php';
        }
        if($url[1] == "checkout"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/plano/checkout.php';
        }
    }
}
?>