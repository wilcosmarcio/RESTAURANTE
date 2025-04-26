<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

if($validacao == 'ok'){
    include('app/helpers/produtos/class.itens.php');
    $object_item = new produtos;

    if($url[0] == "mesas"){
        if($url[1] == "novo"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/mesas/cadastro.php';
        }
        
        if($url[1] == "editar"){
            $sql_mesas = mysqli_query($conexao,"SELECT * FROM mesas WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
	        $resultado_mesas = mysqli_fetch_assoc($sql_mesas);
	        
	        $titulomesas    = $resultado_mesas['titulo'];
	        
	        
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/mesas/editar.php';
        }
        
        if($url[1] == "qrcode"){
            $sql_mesas = mysqli_query($conexao,"SELECT * FROM mesas WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
	        $resultado_mesas = mysqli_fetch_assoc($sql_mesas);
	        
	        $titulomesas    = $resultado_mesas['titulo'];
	        
	        
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/mesas/qrcode.php';
        }
        
        if($url[1] == "remover"){
	        $delete = "DELETE FROM `mesas` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'";
			mysqli_query($conexao, $delete);
	        
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/mesas/remover.php';
        }
        
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/mesas/index.php';
        }
    }
    
}

//redireciona se o login nao estiver efetuado
    if($validacao == 'false'){
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
    }
?>