<?php
if($validacao == 'ok'){
    $sqlComandaInt = mysqli_query($conexao,"SELECT user_id,
    IdPedido,
    DATE_FORMAT(data_completa, '%d/%m/%Y %H:%i:%s') AS data_completa,
    codigo_loja,
    id_loja,
    mesa,
    notificacao_wpp,
    preco,
    CASE
        WHEN status = '1' THEN '<span style=\"color: blue;\">Aberta</span>'
        WHEN status = '2' THEN '<span style=\"color: yellow;\">Prepando</span>'
        WHEN status = '3' THEN '<span style=\"color: green;\">Saiu para entrega</span>'
        WHEN status = '4' THEN '<span style=\"color: green;\">Finalizada</span>'
        WHEN status = '5' THEN '<span style=\"color: red;\">Cancelado</span>'
        ELSE 'Erro interno'
    END AS status FROM ComandaPedidos WHERE comanda = '".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' ORDER BY 'id'") or die("Erro1");
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
<?php
    foreach ($resultado as $key => $value) {
        $sql_item = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE id = '".$value['IdItem']."' and codigo_loja = '".$resultadoComandaInt['codigo_loja']."'") or die("Erro");
        $resultado_item = mysqli_fetch_assoc($sql_item);
        if ($value['adicional'] <> '') {
            if (count($value['adicional']) > '0') {
                foreach ($value['adicional'] as $adicional) {
                    $sql_adicionais = mysqli_query($conexao,"SELECT * FROM adicional WHERE id = '".$adicional['id']."'") or die("Erro");
                    $resultado_adicionais = mysqli_fetch_assoc($sql_adicionais);
                    if($resultado_adicionais['id'] <> ''){
                        if($adicional['preco'] == ''){
                            $PrecoAdicional  = '0';
                        } else {
                            $PrecoAdicional  = $adicional['preco'];
                        }
                        $totalAdicional += ($adicional['qtde'] * $PrecoAdicional) * $value['QtdeItem'];
                    }
                }
            }
        }
        if ($value['variacao'] <> '') {
            if (count($value['variacao']) > '0') {
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
                        $totalVariacao += ($PrecoVariacao * $value['QtdeItem']);
                    }
                }
            }
        }
        $totalProduto   += ($value['preco'] * $value['QtdeItem']);
        $subtotal       = ($totalProduto + $totalAdicional + $totalVariacao);
        $subtotal2      = $totalProduto + $totalAdicional + $totalVariacao;
    }
    $desconto       = 0;
    $taxaServico    = ($subtotal2 / 100) * 0;
    $total          = ($subtotal2 - $desconto + $resultadoComandaTaxa['TaxaEntrega']) + $taxaServico;
}
$queryprice = "UPDATE ComandaId SET
    total_concluido   = '".$total."'
    WHERE comanda='".$url[2]."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
mysqli_query($conexao, $queryprice);
?>