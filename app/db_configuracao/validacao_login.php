<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    
?>
<?php
if($_COOKIE['cookieappid'] == '' && $_COOKIE['cookiesessionid'] == ''){
    //variaveis login
    $id_user            = $_SESSION['id'];
    
    
    $sql_user_cookie = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE id = '".$id_user."' ORDER BY 'id'") or die("Erro");
	$resultado_user_cookie = mysqli_fetch_assoc($sql_user_cookie);
	
	//variaveis login
    $nome_user          = $resultado_user_cookie['nome'];
    $telefone_user      = $resultado_user_cookie['telefone'];
    $email_user         = $resultado_user_cookie['email'];
    $cpf_user           = $resultado_user_cookie['cpf'];
    $cep_user           = $resultado_user_cookie['cep'];
    $rua_user           = $resultado_user_cookie['rua'];
    $numero_user        = $resultado_user_cookie['numero'];
    $bairro_user        = $resultado_user_cookie['bairro'];
    $cidade_user        = $resultado_user_cookie['cidade'];
    $uf_user            = $resultado_user_cookie['uf'];
    $desconto_user      = $resultado_user_cookie['desconto'];
	$nivel_user         = $resultado_user_cookie['nivel_usuario'];
	$principal          = $resultado_user_cookie['principal'];
	$codigo_loja        = $resultado_user_cookie['codigo_loja'];
	$id_loja            = $resultado_user_cookie['id_loja'];
	
    //verifica se a sessao esta criada
    if($_SESSION['nome'] <> ''){
	    $validacao = 'ok';
	} else {
	    $validacao = 'false';
	}
	
	if($validacao == 'false'){
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
	        $botao_login_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/user" class="btn btn-sm btn-light navbar-brand ms-3 d-lg-none" style="color: #009CFF">Entre</a>';
	    } else {
	        $botao_login    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/user" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block" data-toggle="modal" data-target="#myModal">Entre</a>';
	    }
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
	        $botao_sair_m  = '';
	    } else {
	        $botao_sair    = '';
	    }
	} else {
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
	        $botao_login_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/checkout" class="btn btn-sm btn-light navbar-brand ms-3 d-lg-none" style="color: #009CFF"><b style="float: left;"><i class="fa fa-shopping-cart"></i></b> <div id="qtde"></div></a>';
	    } else {
	        $botao_login    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/checkout" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block"><b style="float: left;"><i class="fa fa-shopping-cart"></i></b> <div id="qtde"></div></a>';
	    }
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
	        $botao_sair_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/sair" class="nav-item nav-link">Sair</a>';
	    } else {
	        $botao_sair    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/sair" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block" data-toggle="modal" data-target="#myModal">Sair</a>';
	    }
	}
} else {
    //variaveis login
    $cookieappid_check        = md5($_COOKIE['cookieappid']);
    $cookiesessionid_check    = md5($_COOKIE['cookiesessionid']);
    
    
    $sql_user_cookie = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE cookie_appid = '".$cookieappid_check."' and cookie_sessionid = '".$cookiesessionid_check."' ORDER BY 'id'") or die("Erro");
	$resultado_user_cookie = mysqli_fetch_assoc($sql_user_cookie);
	
	//variaveis login
    $id_user            = $resultado_user_cookie['id'];
    $nome_user          = $resultado_user_cookie['nome'];
    $telefone_user      = $resultado_user_cookie['telefone'];
    $email_user         = $resultado_user_cookie['email'];
    $cpf_user           = $resultado_user_cookie['cpf'];
    $cep_user           = $resultado_user_cookie['cep'];
    $rua_user           = $resultado_user_cookie['rua'];
    $numero_user        = $resultado_user_cookie['numero'];
    $bairro_user        = $resultado_user_cookie['bairro'];
    $cidade_user        = $resultado_user_cookie['cidade'];
    $uf_user            = $resultado_user_cookie['uf'];
    $desconto_user      = $resultado_user_cookie['desconto'];
    $nivel_user         = $resultado_user_cookie['nivel_usuario'];
    $principal          = $resultado_user_cookie['principal'];
    $codigo_loja        = $resultado_user_cookie['codigo_loja'];
	$id_loja            = $resultado_user_cookie['id_loja'];
    
	
    //verifica se a sessao esta criada
    if($resultado_user_cookie['id'] <> ''){
	    $validacao = 'ok';
	} else {
	    $validacao = 'false';
	}
	
	if($validacao == 'false'){
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
	        $botao_login_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/user" class="btn btn-sm btn-light navbar-brand ms-3 d-lg-none" style="color: #009CFF">Entre</a>';
	    } else {
	        $botao_login    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/user" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block" data-toggle="modal" data-target="#myModal">Entre</a>';
	    }
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
	        $botao_sair_m  = '';
	    } else {
	        $botao_sair    = '';
	    }
	} else {
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
	        $botao_login_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/checkout" class="btn btn-sm btn-light navbar-brand ms-3 d-lg-none" style="color: #009CFF; width: 100px;"><b style="float: left;"><i class="fa fa-shopping-cart"></i></b> <div id="qtde"></div></a>';
	    } else {
	        $botao_login    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/checkout" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block"><b style="float: left;"><i class="fa fa-shopping-cart"></i></b> <div id="qtde"></div></a>';
	    }
	    
	    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
	        $botao_sair_m  = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/sair" class="nav-item nav-link">Sair</a>';
	    } else {
	        $botao_sair    = '<a href="'.$resultado_dados['certificado'].'://'.$host.'/sair" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block" data-toggle="modal" data-target="#myModal">Sair</a>';
	    }
	}
}
?>