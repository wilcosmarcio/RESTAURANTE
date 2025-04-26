<?php 
		
		//PAGINACAO
		    if(isset($url[3])){
                $sql = mysqli_query($conexao,"SELECT COUNT(id) AS num_result FROM ask WHERE status = '1' and titulo LIKE '%".$url3."%' OR pergunta LIKE '%".$url3."%' ORDER BY id DESC LIMIT $inicio, $qnt_result_pg") or die("Erro");
            } else {
                $sql = mysqli_query($conexao,"SELECT COUNT(id) AS num_result FROM ask WHERE status = '1'") or die("Erro");
            }
		
            
    		$row_pg = mysqli_fetch_assoc($sql);
    		
    		
    		//echo $row_pg['num_result'];
    		//Quantidade de pagina 
    		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    		
    		//Limitar os link antes depois
    		$max_links = 2;
            //FIM PAGINACAO
		
		if(isset($url[3])){
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/1/busca/".$url[3]."'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$pag_ant/busca/".$url[3]."' class='btn btn-success'>$pag_ant</a> ";
			}
		}
			
		echo "<a class='btn btn-primary' disabled>$pagina</a> ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$pag_dep/busca/".$url[3]."' class='btn btn-success'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$quantidade_pg/busca/".$url[3]."'>Ultima</a>";
		
		} else {
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/1/busca/".$url[3]."'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$pag_ant/busca/".$url[3]."' class='btn btn-success'>$pag_ant</a> ";
			}
		}
			
		echo "<a class='btn btn-primary' disabled>$pagina</a> ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$pag_dep' class='btn btn-success'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='".$resultado_dados['certificado']."://".$host."/perguntas/$quantidade_pg'>Ultima</a>";
		
		}
		
		?>