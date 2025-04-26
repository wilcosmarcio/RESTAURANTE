<?php include('app/php/autoload.php');?>
<?php
//protecao login
if($validacao == 'ok'){
    if($plano == '1' || $plano == '3'){ 
        if($url[0] == "comandas"){
            if($url[1] == ""){
                require_once 'app/layout/agenda/comandas/index.php';
                //parar notificacao do admin
                $update = "UPDATE ComandaPedidos SET
                	notificacao_admin = '1'
                WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and notificacao_admin = ''";
                mysqli_query($conexao, $update);
            }
            if($url[1] == "listagem"){
                require_once 'app/layout/agenda/comandas/listagem.php';
            }
            if($url[1] == "api-listagem"){
                $sql_comandaslinks = mysqli_query($conexao,"SELECT 
                    cp.IdPedido AS IdPedido,
                    cp.user_name AS user_name,
                    ci.tipo_pedido AS tipo_pedido,
                    ci.id AS Idpedido,
                    DATE_FORMAT(cp.data_completa, '%d/%m/%Y %H:%i:%s') AS data_completa,
                    cp.comanda AS comanda,
                    cp.status AS statusNumber,
                    CASE
                        WHEN cp.status = '1' THEN '<span style=\"color: blue;\">Aberta</span>'
                        WHEN cp.status = '2' THEN '<span style=\"color: yellow;\">Preparando</span>'
                        WHEN cp.status = '3' THEN '<span style=\"color: green;\">Saiu para entrega</span>'
                        WHEN cp.status = '4' THEN '<span style=\"color: green;\">Finalizada</span>'
                        WHEN cp.status = '5' THEN '<span style=\"color: red;\">Cancelado</span>'
                        WHEN cp.status = '6' THEN '<span style=\"color: yellow;\">Pagamento Pendente</span>'
                        ELSE 'Erro interno'
                    END AS status,
                    sn.nome_empresa AS nome_empresa
                FROM 
                    ComandaPedidos AS cp
                JOIN 
                    sobrenos AS sn ON cp.id_loja = sn.id_loja
                JOIN 
                    ComandaId AS ci ON cp.comanda = ci.comanda
                WHERE cp.codigo_loja = '".$codigo_loja."' and cp.id_loja = '".$id_loja."'
                GROUP BY 
                    cp.comanda
                ORDER BY 
                    cp.IdPedido DESC;
                ") or die("Erro");
                $total_sql  = mysqli_num_rows($sql_comandaslinks);
                
                $totalRegistros     = $total_sql;
                $registrosPorPagina = '24';
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                
                $paginaAtual = isset($url[2]) ? $url[2] : 1;
                
                $offset = ($paginaAtual - 1) * $registrosPorPagina;
                
                $sql_comandas = mysqli_query($conexao,"SELECT 
                    cp.IdPedido AS IdPedido,
                    cp.user_name AS user_name,
                    ci.tipo_pedido AS tipo_pedido,
                    ci.id AS Idpedido,
                    DATE_FORMAT(cp.data_completa, '%d/%m/%Y %H:%i:%s') AS data_completa,
                    cp.comanda AS comanda,
                    cp.status AS statusNumber,
                    CASE
                        WHEN cp.status = '1' THEN '<span style=\"color: blue;\">Aberta</span>'
                        WHEN cp.status = '2' THEN '<span style=\"color: yellow;\">Preparando</span>'
                        WHEN cp.status = '3' THEN '<span style=\"color: green;\">Saiu para entrega</span>'
                        WHEN cp.status = '4' THEN '<span style=\"color: green;\">Finalizada</span>'
                        WHEN cp.status = '5' THEN '<span style=\"color: red;\">Cancelado</span>'
                        WHEN cp.status = '6' THEN '<span style=\"color: yellow;\">Pagamento Pendente</span>'
                        ELSE 'Erro interno'
                    END AS status,
                    sn.nome_empresa AS nome_empresa
                FROM 
                    ComandaPedidos AS cp
                JOIN 
                    sobrenos AS sn ON cp.id_loja = sn.id_loja
                JOIN 
                    ComandaId AS ci ON cp.comanda = ci.comanda
                WHERE cp.codigo_loja = '".$codigo_loja."' and cp.id_loja = '".$id_loja."'
                GROUP BY 
                    cp.comanda
                ORDER BY 
                    cp.IdPedido DESC
                    LIMIT $offset, $registrosPorPagina;
                ") or die("Erro");
                
                echo '<div class="row">';
        while($linhas=mysqli_fetch_assoc($sql_comandas)){
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <div class="col-lg-3">
            <div style="border: 1px solid grey; border-radius: 25px; padding: 25px;">
                <div style="float: right; font-size: 12px;"><b>Pedido: <?php echo $linhas['Idpedido'];?></b></div>
                <h4 style="color: #4db6f9;"><?php if($linhas['tipo_pedido'] == ''){ echo '<br>'; } else { echo strtoupper($linhas['tipo_pedido']); }?></h4>
                <b><?php echo $linhas['user_name'];?></b>
                <br>
                <b style="font-size: 13px;"><?php echo $linhas['data_completa'];?></b>
                <br><br>
                <a href="https://<?php echo $host;?>/comandas/conteudo/<?php echo $linhas['comanda'];?>" class="btn btn-dark" style="width: 100%;">Ver itens</a>
                <br><br>
                <a href="https://<?php echo $host;?>/comandas/imprimir/<?php echo $linhas['comanda'];?>" class="btn btn-secondary" style="width: 100%;" target="_blank">Imprimir pedido <i class="fa fa-print"></i></a>
            </div>
            <br>
        </div>
        <?php
        }
        echo '</div>';
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    if ($i == $paginaAtual) {
                        echo '<button onclick="fazerRequisicao('.$i.')" style="margin-left: 25px;
    background: #4db6f9;
    color: #fff;
    border-radius: 4px;
    padding: 8px 25px;
    white-space: nowrap;
    transition: 0.3s;
    font-size: 14px;
    display: inline-block; border: 0;">Página '.$i.'</button>';
                    } else {
                        echo '<button onclick="fazerRequisicao('.$i.')" style="margin-left: 25px;
    background: blue;
    color: #fff;
    border-radius: 4px;
    padding: 8px 25px;
    white-space: nowrap;
    transition: 0.3s;
    font-size: 14px;
    display: inline-block; border: 0;">Página '.$i.'</button>';
                    }
                }
            }
            if($url[1] == "conteudo"){
                require_once 'app/layout/agenda/comandas/conteudo/index.php';
            }
            if($url[1] == "bipe"){
                $sql_sobre = mysqli_query($conexao,"SELECT * FROM ComandaPedidos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and notificacao_admin = ''") or die("Erro");
                $total  = mysqli_num_rows($sql_sobre);
                if($total > 0){
                    echo $total;
                    echo    '<audio src="https://'.$host.'/uploads/audios/alerta.mp3" autoplay loop></audio>';
                }
            }
            if($url[1] == "update"){
                if(isset($_POST['BtnObs'])){
                    $obs      = str_replace($array_post, '', $_POST['obs']);
                    
                    $update = "UPDATE ComandaId SET
                    	obs = '".$obs."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and comanda = '".$url[2]."'";
                    mysqli_query($conexao, $update);
                    
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/comandas/conteudo/".$url[2]."'>";
                }
            }
            if($url[1] == "imprimir"){
                require_once 'app/layout/agenda/comandas/conteudo/imprimir.php';
            }
        }
    }
}
//redireciona se o login nao estiver efetuado
if($validacao == 'false'){
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/'>";
}
?>