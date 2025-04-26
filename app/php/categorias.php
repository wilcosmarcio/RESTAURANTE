<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

if($validacao == 'ok'){
    include('app/helpers/produtos/class.itens.php');
    $object_item = new produtos;

    if($url[0] == "categorias"){
        if($url[1] == "novo"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/categorias/cadastro.php';
        }
        
        if($url[1] == "editar"){
            $sql_categorias = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[2]."'") or die("Erro");
	        $resultado_categorias = mysqli_fetch_assoc($sql_categorias);
	        
	        $tituloCategoria    = $resultado_categorias['titulo'];
	        $DestaqueCategoria  = $resultado_categorias['destaque'];
	        
	        if($DestaqueCategoria == '1'){
	            $destaqueCheck  = 'checked';
	        }
	        if($DestaqueCategoria == '2'){
	            $destaqueCheckAtivo  = 'checked';
	        }
	        
	        if($resultado_categorias['file'] == ''){
                $imagem = '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="60px; height: 60px;">';
            } else {
                $imagem = '<img src="'.$resultado_categorias['file'].'" style="60px; height: 60px;">';
            }
	        
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/categorias/editar.php';
        }
        
        if($url[1] == "remover"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/categorias/remover.php';
        }
        
        if($url[1] == ""){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/produtos/categorias/index.php';
        }
    }
}
?>