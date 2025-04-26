<?php
//configuracao Faixa Cep
include('app/helpers/class.faixacep/class.faixacep.php');
$object_FaixaCep = new FaixaCep;
$object_FaixaCep->cadFaixaCEP();
?>