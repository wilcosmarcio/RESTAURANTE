<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

if($validacao == 'ok'){
    include('app/helpers/produtos/class.itens.php');
    $object_item = new produtos;

    if($url[0] == "variacoes"){
        if($url[1] == "novo"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/variacoes/cadastro.php';
        }
        
        if($url[1] == "AdicionarVariacoes"){
            if($url[2] == "remover"){
                $delete = "DELETE FROM `variacao_item` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[3]."'";
			    mysqli_query($conexao, $delete);
			    
			    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/variacoes/AdicionarVariacoes/".$url[4]."'>";
            } else {
                $sql_adicional = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
    	        $resultado_adicional = mysqli_fetch_assoc($sql_adicional);
    	        
    	        $tituloVariacao    = $resultado_adicional['titulo'];
    	        
    	        require_once 'app/layout/'.$resultado_templete_i['templete'].'/variacoes/AdicionarVariacoes.php';
            }
	        
            
        }
        
        if($url[1] == "remover"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/variacoes/remover.php';
        }
        
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/variacoes/index.php';
        }
    }
    
}

//redireciona se o login nao estiver efetuado
    if($validacao == 'false'){
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
    }
?>