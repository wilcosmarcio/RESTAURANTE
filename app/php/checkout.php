<?php
    
		if($url[0] == "checkout"){
		    //Conta total de items
            $json       = json_encode($_SESSION['carrinho']);
            $resultado  = json_decode($json);
                        
            foreach($_SESSION['carrinho'] as $id => $qtd){
                $total += count($id);
            }
            
            
            if($validacao == 'ok'){ //redirect se nao estiver logado
            //inicio das acoes
            if($url[1] == "acao"){
                session_start();          
                if(!isset($_SESSION['carrinho'])){
                    $_SESSION['carrinho'] = array();
                }
                    
                //Conta total de items
                if($url[2] == 'total'){
                    echo $total;
                }
                    
                //adicionar
                if($url[2] == 'add'){
                    $id = intval($url[3]);
                    $sql_item       = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$id."' ORDER BY id DESC") or die("Erro");
    	            $resultado_item = mysqli_fetch_assoc($sql_item);
    	            
    	            
                        if(!isset($_SESSION['carrinho'][$id])){
                            $_SESSION['carrinho'][$id] = 1;
                            echo '<b style="color: green;">Adicionado!</b>';
                        }else{
                            //$_SESSION['carrinho'][$id] += 1;
                            echo '<b style="color: green;"><a href="https://'.$host.'/checkout">Ir para Checkout <i class="fa fa-shopping-cart"></i></a></b>';
                        }                       
    	            
                    
                }
                
                //adicionar checkout
                if($url[2] == 'somar'){
                    $id = intval($url[3]);
                    $sql_item       = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$id."' ORDER BY id DESC") or die("Erro");
    	            $resultado_item = mysqli_fetch_assoc($sql_item);
    	            
    	            
                        if(!isset($_SESSION['carrinho'][$id])){
                            $_SESSION['carrinho'][$id] = 1;
                        }else{
                            //$_SESSION['carrinho'][$id] += 1;
                        }
    	            
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/checkout'>";
                }
                //Diminuir qtde checkout
                if($url[2] == 'subtrair'){
                    $id = intval($url[3]);
                    $qtd = intval($qtd);
                              
                    $json       = json_encode($_SESSION['carrinho']);
                    
                    $resultado  = json_decode($json);
                        
                    foreach($_SESSION['carrinho'] as $id => $qtd){
                        if(intval($url[3]) == $id){
                            if($qtd <= 1){
                                unset($_SESSION['carrinho'][$id]);
                            } else {
                                $_SESSION['carrinho'][$id] = $qtd - 1;
                            }
                        }
                    }
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/checkout'>";
                }
                
                    
                //Remover
                if($url[2] == 'del'){
                    $id = intval($url[3]);
                    if(isset($_SESSION['carrinho'][$id])){
                        unset($_SESSION['carrinho'][$id]);
                    }
                }
                    
                //Diminuir qtde
                if($url[2] == 'down'){
                    $id = intval($url[3]);
                    $qtd = intval($qtd);
                              
                    $json       = json_encode($_SESSION['carrinho']);
                    
                    $resultado  = json_decode($json);
                        
                    foreach($_SESSION['carrinho'] as $id => $qtd){
                        if(intval($url[3]) == $id){
                            if($qtd <= 1){
                                unset($_SESSION['carrinho'][$id]);
                            } else {
                                $_SESSION['carrinho'][$id] = $qtd - 1;
                            }
                        }
                    }
                }
                    
                //limpar
                if($url[2] == 'limpar'){
                    $json       = json_encode($_SESSION['carrinho']);
                                
                    $resultado  = json_decode($json);
                                    
                    foreach($resultado as $id => $qtd){
                        if(isset($_SESSION['carrinho'][$id])){
                            unset($_SESSION['carrinho'][$id]);
                        }
                    }
                }
                   
            } else {
                //Finalizar
                if($url[1] == 'finalizar'){
                    if($total > 0){
                        session_start();          
                        //var_dump($_SESSION['carrinho']);
                        $json       = json_encode($_SESSION['carrinho']);
                        $resultado  = json_decode($json);
                        
                        foreach($_SESSION['carrinho'] as $id => $qtd){
                            $sql_itens = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$id."'") or die("Erro"); $resultado_itens = mysqli_fetch_assoc($sql_itens);
                            $valorTotal += $resultado_itens['preco'] * $qtd;
                        }
                        
                        $descontoCheckout   = ($valorTotal / 100) * $desconto_user;
                        $totalDesconto      = $valorTotal - $descontoCheckout;
                        
                        $sql = "INSERT INTO pedidos(user_id, data, codigo_data, status, valor_total, desconto) VALUES ('".$id_user."', '".date('d/m/Y H:i')."', '".strtotime(date('Y-m-d'))."', '1', '".$valorTotal."', '".$descontoCheckout."')"; 
        	            mysqli_query($conexao, $sql);
        	            
        	            $sql_pedido_user = mysqli_query($conexao,"SELECT * FROM pedidos WHERE user_id = '".$id_user."' ORDER BY id DESC") or die("Erro");
    	                $resultado_pedido_user = mysqli_fetch_assoc($sql_pedido_user);
        	            
        	            
        	            session_start();          
                        //var_dump($_SESSION['carrinho']);
                        $json       = json_encode($_SESSION['carrinho']);
                        $resultado  = json_decode($json);
                        
                        foreach($_SESSION['carrinho'] as $id => $qtd){
                            $codigo_download    = md5(rand(1,9999).rand(1,9999).date('d-m-Y H:i:s').$id_user.$resultado_pedido_user['id'].$resultado_itens['id']).'-'.md5(rand(1,9999).rand(1,9999).date('d-m-Y H:i:s').$id_user);
                            
                            $sql_itens = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$id."'") or die("Erro"); $resultado_itens = mysqli_fetch_assoc($sql_itens);
                            
    	                    $sql = "INSERT INTO pedido_lista(pedido_id, titulo, id_item, preco, qtde, codigo_download, user_id) VALUES ('".$resultado_pedido_user['id']."', '".$resultado_itens['categoria']."', '".$resultado_itens['id']."', '".$resultado_itens['preco']."', '".$qtd."', '".$codigo_download."', '".$id_user."')"; 
        	                mysqli_query($conexao, $sql);
                        }
                        
                        //limpar carrinho de compras apos gravar no banco
                        $json       = json_encode($_SESSION['carrinho']);
                        $resultado  = json_decode($json);            
                        foreach($resultado as $id => $qtd){
                            if(isset($_SESSION['carrinho'][$id])){
                                unset($_SESSION['carrinho'][$id]);
                            }
                        }
                        
                        echo "<script> window.location.href='https://".$host."/user/pedido/".$resultado_pedido_user['id']."'; </script>";
                    } else {
                        echo "<script> window.location.href='https://".$host."/'; </script>"; //redirect se o carrinho estiver vazio
                    }
                } else {
                    include('app/layout/'.$resultado_templete_i['templete'].'/checkout/index.php');
                }
            }
		    
		} 
    }

?>