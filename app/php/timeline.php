<?php
//whatsapp
include('app/helpers/classes/whatsapp/class.whatsapp.php');
$obj_whatsapp = new whatsapp;
if($validacao == 'ok'){
    if($url[0] == "timeline"){
        $sqlComandaInt = mysqli_query($conexao,"SELECT user_id,
            IdPedido,
            DATE_FORMAT(data_completa, '%d/%m/%Y %H:%i:%s') AS data_completa,
            codigo_loja,
            id_loja,
            mesa,
            notificacao_wpp,
            DATE_FORMAT(data_status_1, '%d/%m/%Y %H:%i:%s') AS data_status_1,
            DATE_FORMAT(data_status_2, '%d/%m/%Y %H:%i:%s') AS data_status_2,
            DATE_FORMAT(data_status_3, '%d/%m/%Y %H:%i:%s') AS data_status_3,
            DATE_FORMAT(data_status_4, '%d/%m/%Y %H:%i:%s') AS data_status_4,
            DATE_FORMAT(data_status_5, '%d/%m/%Y %H:%i:%s') AS data_status_5,
            CASE
                WHEN status = '1' THEN '<span style=\"color: blue;\">Aberta</span>'
                WHEN status = '2' THEN '<span style=\"color: yellow;\">Prepando</span>'
                WHEN status = '3' THEN '<span style=\"color: green;\">Saiu para entrega</span>'
                WHEN status = '4' THEN '<span style=\"color: green;\">Finalizada</span>'
                WHEN status = '5' THEN '<span style=\"color: red;\">Cancelado</span>'
                ELSE 'Erro interno'
            END AS status FROM ComandaPedidos WHERE comanda = '".$url[1]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' ORDER BY 'id'") or die("Erro1");
        $resultadoComandaInt = mysqli_fetch_assoc($sqlComandaInt);
        
        $sqlComandaId = mysqli_query($conexao,"SELECT * FROM ComandaId WHERE comanda = '".$url[1]."'  ORDER BY 'id'") or die("Erro1");
        $resultadoComandaId = mysqli_fetch_assoc($sqlComandaId);
        
        $sqlUser = mysqli_query($conexao,"SELECT * FROM UsersCardapio WHERE id = '".$resultadoComandaId['user_id']."'  ORDER BY 'id'") or die("Erro1");
        $resultadoUser = mysqli_fetch_assoc($sqlUser);
        
        if($url[1] <> "update"){
            if($resultadoComandaInt['IdPedido'] <> ''){
                include('app/layout/agenda/comandas/conteudo/blocos/timeline.php');
            }
        }
        if($url[1] == "update"){
            
            if($url[3] == ''){
                $status_id  = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['status']);
            } else {
                $status_id  = $url[3];
            }
            //preparando
            if($status_id == '2'){
                $query = "UPDATE ComandaPedidos SET
                    data_status_2   = '".date('Y-m-d H:i:s')."',
                    status          = '2'
                    WHERE comanda='".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
                mysqli_query($conexao, $query);
                $obj_whatsapp->enviar_mensagem($status_id);
            }
            //saiu para entrega
            if($status_id == '3'){
                $query = "UPDATE ComandaPedidos SET
                    data_status_3   = '".date('Y-m-d H:i:s')."',
                    status          = '3'
                    WHERE comanda='".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
                mysqli_query($conexao, $query);
                
                //add valor para dashboard financeiro
                include('app/php/timelineprice.php');
                $obj_whatsapp->enviar_mensagem($status_id);
            }
            //finalizado
            if($status_id == '4'){
                $query = "UPDATE ComandaPedidos SET
                    data_status_4   = '".date('Y-m-d H:i:s')."',
                    status          = '4'
                    WHERE comanda='".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
                mysqli_query($conexao, $query);
                //$obj_whatsapp->enviar_mensagem($status_id); //finalizado nao envia mensagem para economizar com api do whatsapp
                //add valor para dashboard financeiro
                include('app/php/timelineprice.php');
            }
            //cancelado
            if($status_id == '5'){
                $query = "UPDATE ComandaPedidos SET
                    data_status_5   = '".date('Y-m-d H:i:s')."',
                    status          = '5'
                    WHERE comanda='".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
                mysqli_query($conexao, $query);
                $obj_whatsapp->enviar_mensagem($status_id);
            }
            if($url[3] <> ''){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/comandas'>";
            }
        }
    }
}
//redireciona se o login nao estiver efetuado
if($validacao == 'false'){
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
}
?>