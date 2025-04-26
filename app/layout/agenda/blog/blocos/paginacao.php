<?php 
		
		$sql = mysqli_query($conexao,"SELECT COUNT(id) AS num_result FROM blog WHERE  categoria_id = '".$resultado_cat['id']."'") or die("Erro");
		$row_pg = mysqli_fetch_assoc($sql);
		
		
		//echo $row_pg['num_result'];
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		
		//Limitar os link antes depois
		$max_links = 2;
		
		if(isset($url[3])){
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/1/categoria/".$url[3]."'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$pag_ant/categoria/".$url[3]."' class='btn btn-success'>$pag_ant</a> ";
			}
		}
			
		echo "<a class='btn btn-primary' disabled>$pagina</a> ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$pag_dep/categoria/".$url[3]."' class='btn btn-success'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$quantidade_pg/categoria/".$url[3]."'>Ultima</a>";
		
		} else {
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/1/categoria/".$url[3]."'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$pag_ant/categoria/".$url[3]."' class='btn btn-success'>$pag_ant</a> ";
			}
		}
			
		echo "<a class='btn btn-primary' disabled>$pagina</a> ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$pag_dep' class='btn btn-success'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/blog/$quantidade_pg'>Ultima</a>";
		
		}
		
		?>