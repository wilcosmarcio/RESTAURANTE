<?php
        $sqlComandaInt = mysqli_query($conexao,"SELECT user_id,
        IdPedido,
        DATE_FORMAT(data_completa, '%d/%m/%Y %H:%i:%s') AS data_completa,
        codigo_loja,
        mesa,
        notificacao_wpp,
        user_name,
        preco,
        CASE
            WHEN status = '1' THEN '<span style=\"color: blue;\">Aberta</span>'
            WHEN status = '2' THEN '<span style=\"color: yellow;\">Prepando</span>'
            WHEN status = '3' THEN '<span style=\"color: green;\">Saiu para entrega</span>'
            WHEN status = '4' THEN '<span style=\"color: green;\">Finalizada</span>'
            WHEN status = '5' THEN '<span style=\"color: red;\">Cancelado</span>'
            ELSE 'Erro interno'
        END AS status FROM ComandaPedidos WHERE comanda = '".$url[2]."' ORDER BY 'id'") or die("Erro1");
        $resultadoComandaInt = mysqli_fetch_assoc($sqlComandaInt);
        
        $sqlComandaId = mysqli_query($conexao,"SELECT * FROM ComandaId WHERE comanda = '".$url[2]."'  ORDER BY 'id'") or die("Erro1");
        $resultadoComandaId = mysqli_fetch_assoc($sqlComandaId);
        
        $sqlComandaTaxa = mysqli_query($conexao,"SELECT * FROM ComandaTaxas WHERE IdComanda = '".$url[2]."'  ORDER BY 'id'") or die("Erro1");
        $resultadoComandaTaxa = mysqli_fetch_assoc($sqlComandaTaxa);
        
        $sqlComandaEndereco = mysqli_query($conexao,"SELECT * FROM UsersEndereco WHERE id = '".$resultadoComandaTaxa['UserAndressId']."' ORDER BY 'id'") or die("Erro1");
        $resultadoComandaEndereco = mysqli_fetch_assoc($sqlComandaEndereco);
        
        $sqlComandaRestaurante = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$resultadoComandaInt['codigo_loja']."'") or die("Erro1");
        $resultadoComandaRestaurante = mysqli_fetch_assoc($sqlComandaRestaurante);
        
        if($resultadoComandaEndereco['id'] <> ''){
            $Endereco   = 'ok';
        } else {
            $Endereco   = 'false';
        }
        
            $sql = "SELECT * FROM ComandaPedidos WHERE comanda = '".$url[2]."' ";
            $result = mysqli_query($conexao, $sql);
            
            $pedidos = array();
            
            while ($row = mysqli_fetch_assoc($result)) {
                $pedidoId = $row["IdPedido"];
            
                $pedidos[$pedidoId] = array(
                    "IdCart" => $row["IdCart"],
                    "IdItem" => $row["IdItem"],
                    "preco" => $row["preco"],
                    "obs" => $row["obs"],
                    "QtdeItem" => $row["QtdeItem"],
                    "status" => $row["status"],
                    "variacao" => array(),
                    "adicional" => array()
                );
            
                $variacaoSql = "SELECT * FROM ComandaVariacoes WHERE IdPedido = '$pedidoId'";
                $variacaoResult = mysqli_query($conexao, $variacaoSql);
            
                while ($variacaoRow = mysqli_fetch_assoc($variacaoResult)) {
                    $pedidos[$pedidoId]["variacao"][] = array(
                        "varPai" => $variacaoRow["varPai"],
                        "VarFilho" => $variacaoRow["VarFilho"],
                        "preco" => $variacaoRow["preco"]
                    );
                }
            
                $adicionalSql = "SELECT * FROM ComandaAdicional WHERE IdPedido = '$pedidoId'";
                $adicionalResult = mysqli_query($conexao, $adicionalSql);
            
                while ($adicionalRow = mysqli_fetch_assoc($adicionalResult)) {
                    $pedidos[$pedidoId]["adicional"][] = array(
                        "id" => $adicionalRow["id"],
                        "qtde" => $adicionalRow["qtde"],
                        "preco" => $adicionalRow["preco"]
                    );
                }
            }
            $json       = json_encode($pedidos);
            $resultado  = json_decode($json, true);
    ?>
<div class="container">
    <div style="border-radius: 10px; border: solid grey 1px;">
        <table class="table table-striped" style="border: 0px;">
            <tbody>
                <tr>
                    <td><b>Pedido: <?php echo $resultadoComandaId['id'];?></b></td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        echo '<b>'.$resultadoComandaRestaurante['nome_empresa'].'</b>';
                        echo '<br>';
                        echo 'Data do pedido: '.$resultadoComandaInt['data_completa'];
                        echo '<br>';
                        echo 'Status: '.$resultadoComandaInt['status'];
                        echo '<br>';
                        
                        if($resultadoComandaInt['mesa'] <> ''){
                            echo '<h3>Mesa: '.$resultadoComandaInt['mesa'].'</h3>';
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div style="padding: 5px;">
            Cliente: <b><?php echo $resultadoComandaInt['user_name'];?></b>
            <br>
            Tipo do pedido: <b><?php echo $resultadoComandaId['tipo_pedido'];?></b>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div style="border-radius: 10px; border: solid grey 1px;">
        <table class="table table-striped" style="border: 0px;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qtde</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
    <?php
    foreach ($resultado as $key => $value) {
        $sql_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$value['IdItem']."' and codigo_loja = '".$resultadoComandaInt['codigo_loja']."'") or die("Erro");
        $resultado_item = mysqli_fetch_assoc($sql_item);
        
        echo '<tr>';
        echo '<td>';
        echo '<b style="font-size: 21px;">'.$resultado_item['titulo'].'</b><br>';
        if ($value['adicional'] <> '') {
            if (count($value['adicional']) > '0') {
                echo "<b>Adicionais:</b><br>";
                
                foreach ($value['adicional'] as $adicional) {
                    $sql_adicionais = mysqli_query($conexao,"SELECT * FROM adicional WHERE id = '".$adicional['id']."'") or die("Erro");
                    $resultado_adicionais = mysqli_fetch_assoc($sql_adicionais);
                    if($resultado_adicionais['id'] <> ''){
                        if($adicional['preco'] == ''){
                            $PrecoAdicional  = '0';
                        } else {
                            $PrecoAdicional  = $adicional['preco'];
                        }
                        echo '<b style="color: grey;"> > '.$resultado_adicionais['titulo'].':</b> <b>'.$adicional['qtde'].'</b> x <b>R$ '.number_format($PrecoAdicional,2,",",".").'</b><br>';
                        $totalAdicional += ($adicional['qtde'] * $PrecoAdicional) * $value['QtdeItem'];
                    }
                }
            }
        }
        if ($value['variacao'] <> '') {
            if (count($value['variacao']) > '0') {
                echo "<b>Variações:</b><br>";
                foreach ($value['variacao'] as $variacao) {
                    $sql_variacao = mysqli_query($conexao,"SELECT * FROM variacao_nome WHERE id = '".$variacao['varPai']."'") or die("Erro");
                    $resultado_variacao = mysqli_fetch_assoc($sql_variacao);
                    
                    $sql_variacaofilho = mysqli_query($conexao,"SELECT * FROM variacao_item WHERE id = '".$variacao['VarFilho']."'") or die("Erro");
                    $resultado_variacaofilho = mysqli_fetch_assoc($sql_variacaofilho);
                    
                    $sql_variacaofilhoPreco = mysqli_query($conexao,"SELECT * FROM cadastrofeed_varfilho WHERE id_variacaofilho = '".$variacao['VarFilho']."' and id_produto = '".$resultado_item['id']."'") or die("Erro");
                    $resultado_variacaofilhoPreco = mysqli_fetch_assoc($sql_variacaofilhoPreco);
                    
                    if($resultado_variacaofilho['id'] <> ''){
                        if($variacao['preco'] == ''){
                            $PrecoVariacao  = '0';
                        } else {
                            $PrecoVariacao  = $variacao['preco'];
                        }
                        echo '<b style="color: grey;"> > '.$resultado_variacao['titulo'].': </b>'.$resultado_variacaofilho['titulo'].' + <b>R$ '.number_format($PrecoVariacao,2,",",".").'</b><br>';
                        $totalVariacao += ($PrecoVariacao * $value['QtdeItem']);
                    }
                }
            }
        }
        echo "Observações: " . $value['obs'] . "<br>";
        $totalProduto   += ($value['preco'] * $value['QtdeItem']);
        $subtotal       = ($totalProduto + $totalAdicional + $totalVariacao);
        $subtotal2      = $totalProduto + $totalAdicional + $totalVariacao;
        echo '</td>';
        echo '<td>'.$value['QtdeItem'].'</td>';
        echo '<td>R$ '.number_format($value['preco'],2,",",".").'</td>';
        echo '</tr>';
    }
    $desconto       = 0;
    $taxaServico    = ($subtotal2 / 100) * 0;
    $total          = ($subtotal2 - $desconto + $resultadoComandaTaxa['TaxaEntrega']) + $taxaServico;
    if($resultadoComandaTaxa['troco'] == ''){
        $troco          = '0';
    } else {
        $troco          = $resultadoComandaTaxa['troco'];
    }
    if($resultadoComandaTaxa['forma_pagamento'] == 'dinheiro'){
        $forma_pagamento    = 'Dinheiro';
    }
    if($resultadoComandaTaxa['forma_pagamento'] == 'credito'){
        $forma_pagamento    = 'Cartão de crédito';
    }
    if($resultadoComandaTaxa['forma_pagamento'] == 'debito'){
        $forma_pagamento    = 'Cartão de débito';
    }
    ?>
        </tbody>
    </table>
</div>
</div>
<br>
<div class="container">
    <div style="border-radius: 10px; border: solid grey 1px;">
        <table class="table table-striped" style="border: 0px;">
            <tbody>
                <tr>
                    <td>Subtotal:</td>
                    <td>R$ <?php echo number_format($subtotal2,2,",",".");?></td>
                </tr>
                <tr>
                    <td>Desconto:</td>
                    <td>R$ <?php echo number_format($desconto,2,",",".");?></td>
                </tr>
                <?php if($Endereco == 'ok'){?>
                <tr>
                    <td>Taxa de entrega:</td>
                    <td>R$ <?php echo number_format($resultadoComandaTaxa['TaxaEntrega'],2,",",".");?></td>
                </tr>
                <?php } ?>
                <?php if($forma_pagamento <> ''){ ?>
                <tr>
                    <td>Forma de pagamento:</td>
                    <td><?php echo $forma_pagamento;?></td>
                </tr>
                <?php } ?>
                <?php if($forma_pagamento == 'Dinheiro'){ ?>
                <tr>
                    <td>Troco para:</td>
                    <td>R$ <?php echo number_format($troco,2,",",".");?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Total:</td>
                    <td>R$ <?php echo number_format($total,2,",",".");?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<?php if($Endereco == 'ok'){?>
<div class="container">
    <div style="border-radius: 10px; border: solid grey 1px;">
        <table class="table table-striped" style="border: 0px;">
            <tbody>
                <tr>
                    <td><b>Endereço de entrega:</b></td>
                </tr>
                <tr>
                    <td><?php echo $resultadoComandaEndereco['nome'];?> - <?php echo $resultadoComandaEndereco['rua'];?>, <?php echo $resultadoComandaEndereco['numero'];?> (<?php echo $resultadoComandaEndereco['complemento'];?>) - <?php echo $resultadoComandaEndereco['bairro'];?> | <?php echo $resultadoComandaEndereco['cidade'];?>-<?php echo $resultadoComandaEndereco['uf'];?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<?php } ?>
<center><b>kifomi.com.br</b></center>
<br>
<script>
    window.print();
    // Fechar a guia após 2 segundos (2000 milissegundos)
    setTimeout(function() {
        window.close();
    }, 2000);
</script>