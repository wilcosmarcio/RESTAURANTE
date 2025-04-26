<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

if($validacao == 'ok'){
    include('app/helpers/produtos/class.itens.php');
    $object_item = new produtos;

    if($url[0] == "adicionais"){
        if($url[1] == "novo"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/adicionais/cadastro.php';
        }
        
        if($url[1] == "editar"){
            $sql_adicional = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
	        $resultado_adicional = mysqli_fetch_assoc($sql_adicional);
	        
	        $tituloAdicional    = $resultado_adicional['titulo'];
	        $PrecoCusto         = $resultado_adicional['preco_custo'];
	        $PrecoVenda         = $resultado_adicional['preco_venda'];
	        $EstoqueAdicional   = $resultado_adicional['estoque'];
	        
	        
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/adicionais/editar.php';
        }
        
        if($url[1] == "remover"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/adicionais/remover.php';
        }
        
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/adicionais/index.php';
        }
    }
    
}

//redireciona se o login nao estiver efetuado
    if($validacao == 'false'){
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
    }
?>