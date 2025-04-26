<?php

	if($total_pay >= 1){
		require_once 'app/layout/bloqueado/index.php';
	} else {
		require_once 'app/layout/'.$resultado_templete_i['templete'].'/sobre/index.php';
	}
