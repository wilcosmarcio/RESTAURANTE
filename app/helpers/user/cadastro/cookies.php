<?php
echo '<script>document.cookie = "cookieappid=; expires=closed; path=/";</script>';

echo '<script>document.cookie = "cookiesessionid=; expires=closed; path=/";</script>';

        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        
        $sql_login = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE login = '".$email."' and codigo_loja = '".$codigo_loja."' LIMIT 1") or die("Erro");
	    $resultado = mysqli_fetch_assoc($sql_login);
	    
	    $passUser   = $resultado['senha']; 

        // Senha digitada pelo usuário
        $passInput  = $senha;
        
        // Verificação da senha
        if (password_verify($passInput, $passUser)) {
            $idLoja     = $resultado['id'];
            
	        $cookieappid        .= base64_encode(md5($idLoja.''.date('d/m/Y H:i:s').''.rand(1,999)));
	        $cookiesessionid    .= base64_encode(md5($idLoja.''.date('d/m/Y H:i:s').''.rand(1,999).''.$cookieappid));
	        
	        $query = "UPDATE usuario_agenda SET
                cookie_appid        = '".md5($cookieappid)."',
                cookie_sessionid    = '".md5($cookiesessionid)."'
                 WHERE id='".$idLoja."'";
            mysqli_query($conexao, $query);
	        
            $data_validade_campanha = date('d F Y', strtotime('+ 365 days'));

            echo '<script>document.cookie = "cookieappid='.$cookieappid.'; expires=Thu, '.$data_validade_campanha.' 12:00:00 UTC; path=/";</script>';

            echo '<script>document.cookie = "cookiesessionid='.$cookiesessionid.'; expires=Thu, '.$data_validade_campanha.' 12:00:00 UTC; path=/";</script>';
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
    		    echo "<script> window.location.href='https://".$host."/user/erro'; </script>";
    		} else {
    		    echo "<script> window.location.href='https://".$host."/dashboard'; </script>";
    		}
	    }



?>





