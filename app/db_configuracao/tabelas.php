<?php
	session_start();
	ini_set('display_errors','Off');
    ini_set('error_reporting', E_ALL );
    error_reporting(0);
	$host           = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	
	$baseUri        = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
    $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	$resultado_dados = mysqli_fetch_assoc($sql);
	$plano  = $resultado_dados['plano'];
	$data_vencimento_plano    = strtotime($resultado_dados['data_vencimento']);
	$data_atual_plano         = strtotime(date('Y-m-d'));
	if($data_atual_plano > $data_vencimento_plano){
	    $status_plano   = '1'; //atrasado
	}
	if($data_atual_plano == $data_vencimento_plano){
	    $status_plano   = '2'; //vence hoje
	}
	
	if($data_atual_plano < $data_vencimento_plano){
	    $status_plano   = ''; //em dia
	}
	$sql_plano = mysqli_query($conexao,"SELECT * FROM planos WHERE id = '".$resultado_dados['plano']."'") or die("Erro");
	$resultado_plano = mysqli_fetch_assoc($sql_plano);
	
	$sql_sobre = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	$resultado_sobre = mysqli_fetch_assoc($sql_sobre);
	
	//URL COMPLETA
	$url_completa   = 'https://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
	
	$dominio_app    = 'app.kifomi.com.br';
	$nomeEmpresa    = 'Kifomi Web Delivery';
	$EmailEmpresa   = 'contato@kifomi.com.br';
	$title          = 'Cardápio virtual - Completo';
	$descricao      = 'Monte seu cardápio virtual agora mesmo em poucos minutos.';
	$favicon        = '';
	$keywords       = '';
	$tagsHead       = '<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XQC4LFRXKW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "G-XQC4LFRXKW");
</script>';
	
	//para proteger contra sql injection
	$array_post = array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE");
	
	//responsivo
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
	//fim responsivo
	
	//Variaveis login
	include('validacao_login.php');
	
	$sql = mysqli_query($conexao,"SELECT * FROM templete ") or die("Erro");
	$resultado_templete_i = mysqli_fetch_assoc($sql);
	
	$sql_variacao      = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	$sqlVariacaoModal  = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	
	$sql_adicional      = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	$sqlAdicionalModal  = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	
	$sql_Mesa      = mysqli_query($conexao,"SELECT * FROM mesas WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	$sqlMesaModal  = mysqli_query($conexao,"SELECT * FROM mesas WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	
	$sql_Categorias      = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' ORDER BY sequencia ASC") or die("Erro");
	$sqlCategoriasModal  = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	
	$sql_Adicional      = mysqli_query($conexao,"SELECT * FROM adicional WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	
	$sql_planos         = mysqli_query($conexao,"SELECT * FROM planos") or die("Erro");
	
	$sql_sobreConfig = mysqli_query($conexao,"SELECT 
    CASE 
        WHEN DAYOFWEEK(CURRENT_DATE) = 2 THEN abertura_seg
        WHEN DAYOFWEEK(CURRENT_DATE) = 3 THEN abertura_ter
        WHEN DAYOFWEEK(CURRENT_DATE) = 4 THEN abertura_qua
        WHEN DAYOFWEEK(CURRENT_DATE) = 5 THEN abertura_qui
        WHEN DAYOFWEEK(CURRENT_DATE) = 6 THEN abertura_sex
        WHEN DAYOFWEEK(CURRENT_DATE) = 7 THEN abertura_sab
        WHEN DAYOFWEEK(CURRENT_DATE) = 1 THEN abertura_dom
    END AS abertura,
    CASE 
        WHEN DAYOFWEEK(CURRENT_DATE) = 2 THEN fechamento_seg
        WHEN DAYOFWEEK(CURRENT_DATE) = 3 THEN fechamento_ter
        WHEN DAYOFWEEK(CURRENT_DATE) = 4 THEN fechamento_qua
        WHEN DAYOFWEEK(CURRENT_DATE) = 5 THEN fechamento_qui
        WHEN DAYOFWEEK(CURRENT_DATE) = 6 THEN fechamento_sex
        WHEN DAYOFWEEK(CURRENT_DATE) = 7 THEN fechamento_sab
        WHEN DAYOFWEEK(CURRENT_DATE) = 1 THEN fechamento_dom
    END AS fechamento,
    tempo_entrega
	FROM sobrenos WHERE id_loja = '".$resultado_dados['id']."' and codigo_loja = '".$codigo_loja."' ORDER BY 'ID'") or die("Erro2");
	$resultado_sobreConfig = mysqli_fetch_assoc($sql_sobreConfig);
?>