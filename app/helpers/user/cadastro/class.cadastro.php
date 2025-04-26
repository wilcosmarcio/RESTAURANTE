<?php
class gravar_agendamento{
    function gravar() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        
        if(isset($_POST['btn_gravar'])){
            //Dados usuario
            $nome_empresa   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['nome_empresa']);
            $RazaoSocial    = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['RazaoSocial']);
            $email          = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['email']);
            $cnpj           = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['cnpj']);
            $cep            = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['cep']);
            $rua            = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['rua']);
            $numero         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['numero']);
            $bairro         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['bairro']);
            $cidade         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['cidade']);
            $uf             = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['uf']);
            $telefone       = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['telefone']);
            $senha          = $_POST['senha'];
            
            $plano          = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['plano']);
            
            //encriptando senha
            $encriptPass = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
            
            $sql_check_email_fly = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE email = '".$email."' ORDER BY 'id'") or die("Erro");
    	    $resultado_check_email_fly = mysqli_fetch_assoc($sql_check_email_fly);
    	    
    	    $sql_check_plano = mysqli_query($conexao,"SELECT * FROM planos WHERE id = '".$plano."' ORDER BY 'id'") or die("Erro");
    	    $resultado_check_plano = mysqli_fetch_assoc($sql_check_plano);
    	    
    	    $sql_check_seller = mysqli_query($conexao,"SELECT * FROM afiliados WHERE codigo = '".$url[2]."' ORDER BY 'id'") or die("Erro");
    	    $resultado_check_seller = mysqli_fetch_assoc($sql_check_seller);
    	    
    	    if($resultado_check_seller['id'] <> ''){
    	        $emailSeller        = $resultado_check_seller['email'];
    	        $percentualSeller   = $resultado_check_seller['porcentagem'];
    	    } else {
    	        $emailSeller        = '';
    	        $percentualSeller   = '';
    	    }
            if($resultado_check_plano['id'] <> ''){
                if($resultado_check_email_fly['id'] == ''){
                    
                    $sql_check_cliente = mysqli_query($conexao,"SELECT * FROM clientes ORDER BY 'id' DESC") or die("Erro");
    	            $resultado_check_cliente = mysqli_fetch_assoc($sql_check_cliente);
    	            
    	            $proximoId          = ($resultado_check_cliente['id'] + 1);
    	            $codificando_loja   .= $nome_empresa.' '.$proximoId.''.rand(1, 9999);
    	            $codigo_loja        = preg_replace('/[ -]+/' , '-' , str_replace(array("#", "'", ";", "*", "=", "'/'", "/", "%", "+", "-", "&", "ˆ", "$", "]", "[", "}", "{"), '', $codificando_loja));
    	            
                    $sql_loja="INSERT INTO clientes (
                                nome_empresa,
                                cnpj_empresa,
                                razao_social,
                                nome_fantasia,
                                email,
                                cep,
                                endereco,
                                numero,
                                bairro,
                                cidade,
                                uf,
                                valor_mensal,
                                plano,
                                codigo_loja,
                                telefone,
                                data_fechamento,
                                data_vencimento,
                                email_afiliado,
                                porcentagem_afiliado
                                ) VALUES(
                                    '".$nome_empresa."',
                                    '".$cnpj."',
                                    '".$RazaoSocial."',
                                    '".$nome_empresa."',
                                    '".$email."',
                                    '".$cep."',
                                    '".$rua."',
                                    '".$numero."',
                                    '".$bairro."',
                                    '".$cidade."',
                                    '".$uf."',
                                    '".$resultado_check_plano['valor']."',
                                    '".$resultado_check_plano['id']."',
                                    '".$codigo_loja."',
                                    '".$telefone."',
                                    '".date('d/m/Y H:i:s')."',
                                    '".date('Y-m-d', strtotime("+7 days"))."',
                                    '".$emailSeller."',
                                    '".$percentualSeller."'
                                )";
                    mysqli_query($conexao, $sql_loja);
                    
                    $sql_loja = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."'") or die("Erro");
    	            $resultado_loja = mysqli_fetch_assoc($sql_loja);
                    
                    //Criando usuario
                    $sql="INSERT INTO usuario_agenda (
                                nome, 
                                login,
                                senha,
                                data_cad,
                                email,
                                cpf,
                                cep,
                                rua,
                                numero,
                                bairro,
                                cidade,
                                uf,
                                telefone,
                                codigo_loja,
                                id_loja,
                                principal
                                ) VALUES(
                                    '".$nome_empresa."', 
                                    '".$email."',
                                    '".$encriptPass."',
                                    '".date('d/m/Y H:i:s')."',
                                    '".$email."',
                                    '".$cnpj."',
                                    '".$cep."',
                                    '".$rua."',
                                    '".$numero."',
                                    '".$bairro."',
                                    '".$cidade."',
                                    '".$uf."',
                                    '".$telefone."',
                                    '".$codigo_loja."',
                                    '".$resultado_loja['id']."',
                                    '1'
                                )";
                        mysqli_query($conexao, $sql);
                        
                        
                        if($_POST['conectado'] == ''){
                            include('app/helpers/user/cadastro/session.php');
                        } else {
                            include('app/helpers/user/cadastro/cookies.php');
                        }
                        
                        include('app/helpers/user/cadastro/notificar.php');
                    } else {
                        echo 'Erro, dados invalidos!';
                    }
                } else { //check plano
                    echo 'Erro, dados invalidos!';
                }
        }
    }
}
?>