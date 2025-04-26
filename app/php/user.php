<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

include('app/helpers/intermediador_pagamento/class.intermediado.php');

include('app/helpers/user/cadastro/class.dados.php');

//configuracao Faixa Cep
include('app/helpers/class.faixacep/class.faixacep.php');
$object_FaixaCep = new FaixaCep;
$object_FaixaCep->update();

//configuracao SEO
include('app/helpers/class.seo/class.seo.php');
$object_Seo = new Seo;
$object_Seo->update();

//whatsapp
include('app/helpers/classes/whatsapp/class.whatsapp.php');
$obj_whatsapp = new whatsapp;

//configuracao Usuarios
include('app/helpers/user/class.usuarios.php');
$object_Usuarios = new Usuarios;
$object_Usuarios->update();

$object_user = new dadosLoja;

$codigo_modulo  = $resultado_config_pagamento['function_class'];

$object_pagamento = new intermediado_pagamento;
if($url[0] == "user"){
    if($url[1] == ""){
        require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/index.php';
    }
    if($url[1] == "seller"){
        require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/index.php';
    }
    if($validacao == 'ok'){
        if($url[1] == "token_notification"){
            $token  = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['token']);
            $sql_token = mysqli_query($conexao,"SELECT * FROM token_notification WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and user_id = '".$id_user."'") or die("Erro");
            $resultado_token = mysqli_fetch_assoc($sql_token);
            
            if($resultado_token['id'] == ''){
                $sql_tokenloja="INSERT INTO token_notification (
                            id_loja,
                            codigo_loja,
                            user_id,
                            token
                            ) VALUES(
                                '".$id_loja."',
                                '".$codigo_loja."',
                                '".$id_user."',
                                '".$token."'
                            )";
                mysqli_query($conexao, $sql_tokenloja);
            } else {
                $query = "UPDATE token_notification SET
                    token        = '".$token."'
                    WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and user_id = '".$id_user."'";
                mysqli_query($conexao, $query);
            }
        }
    }
    
    if($url[1] == "plano"){
        $sql_plan = mysqli_query($conexao,"SELECT * FROM planos WHERE codigo_plano = '".$url[2]."'") or die("Erro");
        $resultado_plan = mysqli_fetch_assoc($sql_plan);
        require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/index.php';
    }
    if($plano == '1'){
        if($url[1] == "config"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/ConfigWhatsApp/index.php';
        }
    }
    //protecao login
    if($validacao == 'ok'){
        if($plano == '1' || $plano == '3'){
            if($url[1] == "config_seo"){
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/ConfigSeo/index.php';
            }
        }
    }
    //protecao login
    if($validacao == 'ok'){
        
        if($url[1] == "horarios"){
            $sql_sobre = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
        	$resultado_sobre = mysqli_fetch_assoc($sql_sobre);
        	
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/horarios/index.php';
        }
        
        if($url[1] == "sobre"){
            $sql_sobre = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
        	$resultado_sobre = mysqli_fetch_assoc($sql_sobre);
        	
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/sobre/index.php';
        }
        if($plano == '1' || $plano == '3'){
            if($url[1] == "FaixaCep"){
                $sql_sobre = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
            	$resultado_sobre = mysqli_fetch_assoc($sql_sobre);
            	if($url[2] == "remover"){
                    $delete = "DELETE FROM `FaixasCEP` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[3]."'";
                    mysqli_query($conexao, $delete);
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/FaixaCep'>";
            	}
            	if($url[2] == "massivo"){
            	    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/FaixaCep/Massivo/listagem.php';
            	}
            	if($url[2] == "novo"){
            	    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/FaixaCep/cadastro.php';
            	}
            	if($url[2] == ""){
            	    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/FaixaCep/index.php';
            	}
            }
        }
        
        if($plano == '1' || $plano == '3'){
            if($principal == '1'){
                if($url[1] == "usuarios"){
                	if($url[2] == "remover"){
                        $delete = "DELETE FROM `usuario_agenda` WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and id = '".$url[3]."' and principal = ''";
                        mysqli_query($conexao, $delete);
                        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/usuarios'>";
                	}
                	if($url[2] == "novo"){
                	    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/usuarios/cadastro.php';
                	}
                	if($url[2] == ""){
                	    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/usuarios/index.php';
                	}
                }
            }
        }
        
        if($url[1] == "logo"){
            $sql_logo = mysqli_query($conexao,"SELECT * FROM logo WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
        	$resultado_logo = mysqli_fetch_assoc($sql_logo);
        	
        	if($resultado_logo['file'] == ''){
                $logo = '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="160px; height: 160px;">';
            } else {
                $logo = '<img src="https://'.$host.'/'.$resultado_logo['file'].'" style="160px; height: 160px;">';
            }
            
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/logo/index.php';
        }
        
        if($url[1] == "banner"){
            $sql_logo = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
        	$resultado_logo = mysqli_fetch_assoc($sql_logo);
        	
        	if($resultado_logo['banner'] == ''){
                $logo = '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="160px; height: 160px;">';
            } else {
                $logo = '<img src="https://'.$host.'/uploads/banner/'.$resultado_logo['banner'].'" style="160px; height: 160px;">';
            }
            
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/banner/index.php';
        }
        
        //redireciona se o login nao estiver efetuado
        if($validacao == 'false'){
            $redirect_login_false = "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['certificado']."://".$host."/'>";
        }
        if($url[1] == "pedidos"){
            //pedidos
            $sql_pedidos            = mysqli_query($conexao,"select * from pedidos WHERE user_id = '".$id_user."' ORDER BY id DESC") or die("Erro");
            $sql_pedidos_total      = mysqli_query($conexao,"select * from pedidos WHERE user_id = '".$id_user."' ORDER BY id DESC") or die("Erro");
                    
            while($linhas_pedidos=mysqli_fetch_assoc($sql_pedidos_total)){ 
                $total_pagamento += $linhas_pedidos['valor'];
            }
            
            //redireciona se o login nao estiver efetuado
            echo $redirect_login_false;   
            if($validacao == 'false'){
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/blocos/login_false.php';
            } else {
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/pedidos/index.php';
            }
        }
        if($url[1] == "dados"){
            //redireciona se o login nao estiver efetuado
            echo $redirect_login_false;   
            if($validacao == 'false'){
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/blocos/login_false.php';
            } else {
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/dados/index.php';
            }
        }
        
        if($url[1] == "pedido"){
            //pedidos
            $sql_pedidos            = mysqli_query($conexao,"select * from pedidos WHERE user_id = '".$id_user."' and id = '".$url[2]."' ORDER BY id DESC") or die("Erro");
            
            
            
            $sql_dados_pedido = mysqli_query($conexao,"select * from pedidos WHERE user_id = '".$id_user."' and id = '".$url[2]."' ORDER BY id DESC") or die("Erro");
    	    $resultado_dados_pedido = mysqli_fetch_assoc($sql_dados_pedido);
    	    
    	    $valor_total    = $resultado_dados_pedido['valor_total'] - $resultado_dados_pedido['desconto'];
    	    $totalPagamento = $resultado_dados_pedido['valor_total'];
            $totalDesconto  = $resultado_dados_pedido['desconto'];
            
            //VARIAVEIS DO AGENDAMENTO
            $pedido_id          = $resultado_dados_pedido['id'];
            $pedido_status      = $resultado_dados_pedido['status'];
            if($resultado_dados_pedido['status'] == '1'){
                $status      = 'Pendente';
            }
            
            if($resultado_dados_pedido['status'] == '2'){
                $status      = 'Finalizado';
            }
            
            if($resultado_dados_pedido['status'] == '3'){
                $status      = 'Cancelado';
            }
                
            $sql_items          = mysqli_query($conexao,"select * from pedido_lista WHERE pedido_id = '".$pedido_id."' ORDER BY id DESC") or die("Erro");
            $sql_items_total    = mysqli_query($conexao,"select * from pedido_lista WHERE pedido_id = '".$pedido_id."' ORDER BY id DESC") or die("Erro");
            
            while($linhas_pedidos=mysqli_fetch_assoc($sql_items_total)){ 
                $total_pagamento += ($linhas_pedidos['preco'] * $linhas_pedidos['qtde']);
            }
            
            if($pedido_id == ''){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['certificado']."://".$host."/'>";
            }
            //redireciona se o login nao estiver efetuado
            echo $redirect_login_false;   
            if($validacao == 'false'){
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/blocos/login_false.php';
            } else {
                require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/pedido/index.php';
            }
            
        }
        
    }
    
    
    if($url[1] == "reset_password"){
        if($url[2] == "request"){
            if(isset($_POST['btn_reset_password'])){
                $email_password = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['email']);
                $sql_check_email_password = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE email = '".$email_password."' ORDER BY 'id'") or die("Erro");
    	        $resultado_check_email_password = mysqli_fetch_assoc($sql_check_email_password);
    	        
    	        $email_sql  = $resultado_check_email_password['email'];
    	        $nome_user  = $resultado_check_email_password['nome'];
    	        $id_user    = $resultado_check_email_password['id'];
    	        
    	        if($resultado_check_email_password['id'] <> ''){
    	            $msg_reset_password = '<div class="alert alert-success" role="alert">Um link foi enviado para o email de cadastro com sucesso. (obs: verifique a caixa de SPAN)</div>';
    	            include('app/helpers/user/reset_password/index.php');
    	            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/index.php';
    	        } else {
    	            $msg_reset_password = '<div class="alert alert-danger" role="alert">E-mail n達o encontrado.</div>';
    	            require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/index.php';
    	        }
            } else {
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['certificado']."://".$host."/'>";
            }
        } else {
            if($url[2] == ""){
                if($validacao == 'false'){
                    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/index.php';
                } else {
                    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/index.php';
                }
            } else {
                $senha_token    = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[2]);
                $senha_user     = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['senha_user']);
                
                $sql_check_email_password = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE reset_password = '".$senha_token."' ORDER BY 'id'") or die("Erro");
    	        $resultado_check_email_password = mysqli_fetch_assoc($sql_check_email_password);
    	        
    	        $email_sql  = $resultado_check_email_password['email'];
    	        $nome_user  = $resultado_check_email_password['nome'];
    	        $id_user    = $resultado_check_email_password['id'];
                
                if($email_sql <> ''){
                    $nova_senha = 'ok';
                    
                    if(isset($_POST['btn_reset_password'])){
                        include('app/helpers/user/reset_password/atualizar_senha.php');
                    }
                    
                    require_once 'app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/index.php';
                } else {
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['certificado']."://".$host."/'>";
                }
            }
        }
    }
}
?>