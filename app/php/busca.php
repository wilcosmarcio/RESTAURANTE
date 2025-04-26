<?php
	if($total_pay >= 1){
		require_once 'app/layout/bloqueado/index.php';
	} else {
		
		$search = $url[1];
		require_once 'app/layout/'.$resultado_templete_i['templete'].'/busca/index.php';
	}