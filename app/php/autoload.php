<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

include('app/helpers/classes/comandas/class.comandas.php');
$obj_comandas = new comandas;

//intermediador de pagamento 
include('app/helpers/intermediador_pagamento/class.intermediado.php');
$codigo_modulo  = $resultado_config_pagamento['function_class'];
$object_pagamento = new intermediado_pagamento;

//configuracao da loja
include('app/helpers/class.loja/class.config.loja.php');
$object_loja = new ConfigLoja;

//Produtos
include('app/helpers/produtos/class.itens.php');
$object_catpizza = new produtos;

//Financeiro Home
include('app/helpers/classes/financeiro/home.php');
$obj_financeiro = new financeiro;

//mensalidades
include('app/helpers/intermediador_pagamento/mensalidade/class.mensalidade.php');
$obj_mensalidade = new mensalidade;
?>