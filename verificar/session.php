<?php
echo '<script>document.cookie = "cookieappid=; expires=closed; path=/";</script>';

echo '<script>document.cookie = "cookiesessionid=; expires=closed; path=/";</script>';
?>
<?php
    $email   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $senha          = $_POST['senha'];
    $codigo_loja    = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['codigo_loja']);
    
    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    
    $sql_login = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE login = '".$email."' and codigo_loja = '".$codigo_loja."' LIMIT 1") or die("Erro");
    $resultado = mysqli_fetch_assoc($sql_login);
    
    
    
    $passUser   = $resultado['senha']; 

    // Senha digitada pelo usuário
    $passInput  = $senha;
    
    // Verificação da senha
    if (password_verify($passInput, $passUser)) {
        session_start();
        $_SESSION['nome']       = $resultado['nome'];
		$_SESSION['login']      = $resultado['login'];
		$idLoja     = $resultado['id'];
		$_SESSION['id']         = $idLoja;
		echo 'Entrando...';
		$query = "UPDATE usuario_agenda SET 
            ultimo_acesso       = '".date('Y-m-d H:i:s')."'
        WHERE id='".$resultado['id']."'";
        mysqli_query($conexao, $query);
    }
    
    $url_redirect = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['url_redirect']);
    if($url_redirect <> ''){
    		if($idLoja == ''){
    		    echo "<script> window.location.href='".$url_redirect."'; </script>";
    		} else {
    		    echo "<script> window.location.href='".$url_redirect."'; </script>";
    		}
    } else {
        if($idLoja == ''){
		    echo "<script> window.location.href='http://".$host."/user/erro'; </script>";
		} else {
		    echo "<script> window.location.href='https://".$host."/'; </script>";
		}
    }
?>