<?php
class whatsapp{
    public function enviar_mensagem($status_id){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
	    
        $sqlComandaId = mysqli_query($conexao,"SELECT * FROM ComandaId WHERE comanda = '".$url[2]."'  ORDER BY 'id'") or die("Erro1");
        $resultadoComandaId = mysqli_fetch_assoc($sqlComandaId);
        echo 'fsadfads:'.$resultadoComandaId['user_id'];
        if($resultado_dados['plano'] == '1'){
            $sqlUser = mysqli_query($conexao,"SELECT * FROM UsersCardapio WHERE id = '".$resultadoComandaId['user_id']."'  ORDER BY 'id'") or die("Erro1");
            $resultadoUser = mysqli_fetch_assoc($sqlUser);
            if($resultadoUser['id'] <> ''){
                if($status_id == '2'){
                    $mensagem     = 'OlÃ¡ '.$resultadoUser['nome'].'! Seu pedido numero: '.$resultadoComandaId['id'].', acabou de ser enviado para cozinha ðŸ˜‹. Fique tranquilo (a) nÃ³s iremos te avisar quando sair para entrega ðŸ›µ';
                }
                if($status_id == '3'){
                    $mensagem     = 'OlÃ¡ '.$resultadoUser['nome'].'! Seu pedido numero: '.$resultadoComandaId['id'].', acabou de sair para entrega ðŸ›µ daqui a pouquinho vai chegar atÃ© vocÃª! ðŸ¤©';
                }
                if($status_id == '4'){
                    $mensagem     = 'OlÃ¡ '.$resultadoUser['nome'].'! Seu pedido numero: '.$resultadoComandaId['id'].', foi finalizado! âœ…';
                }
                if($status_id == '5'){
                    $mensagem     = 'OlÃ¡ '.$resultadoUser['nome'].'! Seu pedido numero: '.$resultadoComandaId['id'].', foi cancelado!';
                }
                
                $dados['messaging_product']     = 'whatsapp';
                $dados['to']                    = '55'.$resultadoUser['telefone'];
                //continuando conversa
                $dados['recipient_type']        = 'individual';
                $dados['type']                  = 'text';
                $dados['text']['preview_url']   = true;
                $dados['text']['body']          = $mensagem;
                
                
                $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://graph.facebook.com/v19.0/352030614665423/messages',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode($dados),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer EAA0RWZBAZBAVYBO7nI4rfHWwWyKe6kW8mmpqSrY8hh0rHqdVxa90MYCqXHcd6x20TbRGy4lyBAIfLfOoiGYHJ3AQdhxY9edZCh6MMjGYOY7ZCQZBSYSKRkfIkIcZBHKRapabYvZAU7Hh82Fiky3MAfrpIxpCV2BW3aZApoatYvZCJhVZA5Uh0hDKiz34L2jQT7RILYZAdz6EDpwOUEa8YC9VOZA9vI0C3PCL"
                    ),
                    ));
                    $response = curl_exec($curl);
                    $resultado = json_decode($response);
                    var_dump($resultado);
                curl_close($curl);
            }
        }
    }
    function cadastro(){
        /*$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
        if($resultado_dados['token_whatsapp'] == ''){
            if(isset($_POST['BtnWhatsApp'])){
                if($_POST['aceites'] == 'sim'){
                    $token_whatsapp = md5($resultado_dados['codigo_loja'].'-'.$resultado_dados['id']);
                    
                    $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.sincrozap.com.br/cadastrar-cliente',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                                "token":"'.base64_encode($token_whatsapp).'",
                                "nome":"'.$resultado_dados['nome_empresa'].'"
                            }',
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Bearer m5M2Tddech4llzBz06SV3zigIL85U26oBLetetT3VZqTWQlXJjZtP2wC01sJesJe'
                        ),
                        ));
                        $response = curl_exec($curl);
                        $resultado = json_decode($response);
                        var_dump($resultado);
                    curl_close($curl);
                    
                    $query = "UPDATE clientes SET
                        token_whatsapp  = '".base64_encode($token_whatsapp)."'
                        WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'";
                    mysqli_query($conexao, $query);
                }
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/config'>";
            }
        }/*
    }
    function auth(){
        /*$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        $sql = mysqli_query($conexao,"SELECT * FROM clientes WHERE codigo_loja = '".$codigo_loja."' and id = '".$id_loja."'") or die("Erro");
	    $resultado_dados = mysqli_fetch_assoc($sql);
        if($resultado_dados['token_whatsapp'] <> ''){
            $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.sincrozap.com.br/qr-code',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$resultado_dados['token_whatsapp']
                    ),
                ));
                $response = curl_exec($curl);
                $resultado = json_decode($response);
                //var_dump($resultado);
                // Exiba a imagem
                if($resultado->qr <> ''){
                echo '
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>A ponte a camera do seu celular para conectar seu WhatsApp.</p>
                            <p>Nosso bot ira fazer todo processo de conexao.</p>
                        </div>
                        <div class="col-lg-6">
                            <img src="data:image/png;base64,'.$resultado->qr.'" alt="Imagem base64" />
                        </div>
                    </div>
                    <br><br>
                </div>
                ';
                } else {
                    echo '<div class="container">
                    <div class="row">
                    <b>Você já está conectado</b> </div> </div>';
                }
            curl_close($curl);
        } else {
            echo '
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Para ultilizar a função de envio de notificaçao via WhatsApp voce precisa permitir a conexao e aceitar os termos de uso:</p>
                            <br>
                            <form action="" method="POST">
                                <input type="checkbox" name="aceites" value="sim" required> Aceitar <a href="https://'.$host.'/termos-bot-whatsapp" target="_blank">termos de uso</a>
                                <br><br>
                                <button type="submit" name="BtnWhatsApp" class="btn btn-success">Começar a usar</button>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <img src="data:image/png;base64,'.$resultado->qr.'" alt="Imagem base64" />
                        </div>
                    </div>
                    <br><br>
                </div>
                ';
        }*/
    }
}
?>