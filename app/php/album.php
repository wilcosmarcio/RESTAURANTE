<?php
	if($total_pay >= 1){
		require_once 'app/layout/bloqueado/index.php';
	} else {
		if($url[0] == "album"){
			
			if($url[1] == "fotos"){
				$sql_album = mysqli_query($conexao,"SELECT * FROM algum_imagem  WHERE id_empresa = '".$resultado_dados['id']."' and codigo = '".$url[2]."' ") or die("Erro");
				$resultado_album = mysqli_fetch_assoc($sql_album);
				
				$sql_fotos = mysqli_query($conexao,"SELECT * FROM galeria_imagens WHERE id_empresa = '".$resultado_dados['id']."' and id_album = '".$resultado_album['id']."'") or die("Erro");
				
				
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/album/fotos/index.php';
			} else {
				$sql_album = mysqli_query($conexao,"SELECT * FROM algum_imagem  WHERE id_empresa = '".$resultado_dados['id']."'") or die("Erro");
				
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/album/index.php';	
			}
		}
	}
?>