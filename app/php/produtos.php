<?php
if($validacao == 'ok'){
    include('app/db_configuracao/tabelas.php');
    include('app/helpers/produtos/class.itens.php');
    $object_item = new produtos;
    $object_item->AddVariacaoItem();
		if($url[0] == "produtos"){
		    if($url[1] == ""){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/index.php';
			}
			
			if($url[1] == "pizza"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/cadastro/pizza.cadastro.php';
			}
			
			if($url[1] == "api-massivo"){
				$object_item->ListagemAdministrativo();
			}
			
			if($url[1] == "massivo"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/massivo.php';
			}
			
			if($url[1] == "api-listagem"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/blocos/listagem.php';
			}
			
			if($url[1] == "novo"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/cadastro/cadastro.php';
			}
		    
		    if($url[1] == "remover"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/remover.php';
			}
			if($url[1] == "duplicar"){
				$sql_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed  WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."' ") or die("Erro");
				$resultado_item = mysqli_fetch_assoc($sql_item);
				if($resultado_item['id'] <> ''){
					$sql="INSERT INTO cadastrofeed(
                        titulo,
                        preco_venda,
                        preco_custo,
                        IdAdministrativo,
                        file,
                        estoque,
                        codigo_loja,
                        id_loja,
                        categoria,
                        status,
                        ean,
                        consumo_local,
                        desconto,
                        descricao,
                        busca,
                        destaque,
                        adicionais,
                        data_cadastro,
                        url
                    ) VALUES(
                        'Item duplicado: ".$resultado_item['titulo']."',
                        '".$resultado_item['preco_venda']."',
                        '".$resultado_item['preco_custo']."',
                        '".$resultado_item['IdAdministrativo']."',
                        '".$resultado_item['file']."',
                        '".$resultado_item['estoque']."',
                        '".$codigo_loja."',
                        '".$id_loja."',
                        '".$resultado_item['categoria']."',
                        '2',
                        '".$resultado_item['ean']."',
                        '".$resultado_item['consumo_local']."',
                        '".$resultado_item['desconto']."',
                        '".$resultado_item['descricao']."',
                        '".$resultado_item['busca']."',
                        '".$resultado_item['destaque']."',
                        '".$resultado_item['adicionais']."',
                        '".date('d/m/Y H:i:s')."',
                        '".$resultado_item['url']."'
                        )";
                    mysqli_query($conexao, $sql);
                    $id_inserido = mysqli_insert_id($conexao);
					//varpai
					$sql_VariacaoPaiCheck      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varpai WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_produto = '".$resultado_item['id']."'") or die("Erro");
					$totalVariacaoPai   = mysqli_num_rows($sql_VariacaoPaiCheck);
					//echo $totalVariacaoPai; //usar para saber de deve ou nao fazer o insert
    				if($totalVariacaoPai > 0){
    					while($linhas_VariacaoPaiCheck = mysqli_fetch_assoc($sql_VariacaoPaiCheck)){
    					    $sql="INSERT INTO cadastrofeed_varpai(
                                id_variacao,
                                id_produto,
                                id_loja,
                                codigo_loja
                            ) VALUES(
                                '".$linhas_VariacaoPaiCheck['id_variacao']."',
                                '".$id_inserido."',
                                '".$id_loja."',
                                '".$codigo_loja."'
                                )";
                            mysqli_query($conexao, $sql);
    					    
    					    $sql_VariacaoFilhoCheck      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varfilho WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_produto = '".$resultado_item['id']."'") or die("Erro");
    					    $totalVariacaoFilho   = mysqli_num_rows($sql_VariacaoFilhoCheck);
    					    if($totalVariacaoFilho > 0){
        					    while($linhas_VariacaoFilhoCheck = mysqli_fetch_assoc($sql_VariacaoFilhoCheck)){
        					        $sql="INSERT INTO cadastrofeed_varfilho(
                                        id_variacao,
                                        id_variacaofilho,
                                        id_produto,
                                        id_loja,
                                        codigo_loja,
                                        preco
                                    ) VALUES(
                                        '".$linhas_VariacaoFilhoCheck['id_variacao']."',
                                        '".$linhas_VariacaoFilhoCheck['id_variacaofilho']."',
                                        '".$id_inserido."',
                                        '".$id_loja."',
                                        '".$codigo_loja."',
                                        '".$linhas_VariacaoFilhoCheck['preco']."'
                                        )";
                                    mysqli_query($conexao, $sql);
        					    }
    					    }
    					}
    				}
					echo "<META HTTP-EQUIV=REFRESH CONTENT = '1;URL=https://".$host."/produtos/editar/".$id_inserido."'>";
					echo 'Processando...';
				}
			}
		    
			if($url[1] == "editar"){
				$sql_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed  WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."' ") or die("Erro");
				$resultado_item = mysqli_fetch_assoc($sql_item);
				
				$sql_VariacaoPaiCheck      = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varpai WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_produto = '".$resultado_item['id']."'") or die("Erro");
				while($linhas_VariacaoPaiCheck = mysqli_fetch_assoc($sql_VariacaoPaiCheck)){
				    $VariacaoPaiCheck   .= $linhas_VariacaoPaiCheck['id_variacao'].',';
				}
				$resultadoVariacaoPaiCheck = mysqli_fetch_assoc($sql_VariacaoPaiCheck);
                if($resultadoVariacaoPaiCheck['id'] == ''){
                    $SqlNotIn   = '';
                } else {
                    $SqlNotIn   = 'and id = '.substr($VariacaoPaiCheck,0,-1);
                }
				$sql_VariacaoPai      = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' '".$SqlNotIn."' ") or die("Erro");
				if($url[3] == "variacoes"){
				    $variacoes_active       = 'active';
				    $variacoes_activein     = 'in active';
				} else {
				    $dados_active           = 'active';
				    $dados_activein         = 'in active';
				}
				if($url[3] == "RemoverVariacao"){
    			    $delete = "DELETE FROM `cadastrofeed_varfilho` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[4]."' and id_produto = '".$url[2]."'";
                    mysqli_query($conexao, $delete);
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."/variacoes'>";
    			}
    			if($url[3] == "RemoverVariacaoPai"){
    			    $sql_variacao = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varpai WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$url[4]."' and id_produto = '".$url[2]."'") or die("Erro");
                    $resultado_variacao = mysqli_fetch_assoc($sql_variacao);
                    if($resultado_variacao['id'] <> ''){
                        $delete = "DELETE FROM `cadastrofeed_varpai` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$url[4]."' and id_produto = '".$url[2]."'";
                        mysqli_query($conexao, $delete);
                        
                        $deletevariacao_item = "DELETE FROM `cadastrofeed_varfilho` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id_variacao = '".$url[4]."' and id_produto = '".$url[2]."'";
                        mysqli_query($conexao, $deletevariacao_item);
                    }
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/produtos/editar/".$url[2]."/variacoes'>";
    			}
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/editar.php';
			}
		}
}
//redireciona se o login nao estiver efetuado
    if($validacao == 'false'){
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
    }
?>