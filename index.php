<?php include('app/db_configuracao/dbconfig.php');?>
<?php include('app/db_configuracao/tabelas.php');?>
<?php include('app/db_configuracao/cobranca.php');?>
<?php
	$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	
	$url = (isset($_GET['url'])) ? $_GET['url']:'index';
	$url = array_filter(explode('/',$url));
	
	$file = 'app/php/'.$url[0].'.php';
	
	if(is_file($file)){
		include $file;
	}else{
		include '404.php';
	}	
	include('cobranca.php');
?>