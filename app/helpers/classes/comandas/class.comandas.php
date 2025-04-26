<?php
class comandas {
    function listagem(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
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
        WHERE cp.codigo_loja = '".$codigo_loja."' and cp.id_loja = '".$id_loja."' and cp.status <> '4' and cp.status <> '5'
        GROUP BY 
            cp.comanda
        ORDER BY 
            cp.IdPedido DESC;
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
                <?php if($linhas['statusNumber'] == '1'){ ?>
                <span>Próxima etapa:</span>
                    <a href="https://<?php echo $host;?>/timeline/update/<?php echo $linhas['comanda'];?>/2" style="width: 100%;" class="btn btn-primary">Preparando >></a>
                    <br>
                <?php } ?>
                <?php if($linhas['statusNumber'] == '2'){ ?>
                <span>Próxima etapa:</span>
                    <a href="https://<?php echo $host;?>/timeline/update/<?php echo $linhas['comanda'];?>/3" style="width: 100%;" class="btn btn-primary">Saiu para entrega >></a>
                    <br>
                <?php } ?>
                <?php if($linhas['statusNumber'] == '3'){ ?>
                <span>Próxima etapa:</span>
                    <a href="https://<?php echo $host;?>/timeline/update/<?php echo $linhas['comanda'];?>/4" style="width: 100%;" class="btn btn-primary">Concluído >></a>
                    <br>
                <?php } ?>
                <?php if($linhas['statusNumber'] == '4'){ ?>
                <span>Próxima etapa:</span>
                    <input type="submit" name="btn_status" class="btn btn-primary" style="width: 100%;" value="Concluído" disabled>
                    <br>
                <?php } ?>
                <?php if($linhas['statusNumber'] == '5'){ ?>
                <span>Próxima etapa:</span>
                    <input type="submit" name="btn_status" class="btn btn-danger" style="width: 100%;" value="Cancelado" disabled>
                    <br>
                <?php } ?>
                <br>
                <a href="https://<?php echo $host;?>/comandas/conteudo/<?php echo $linhas['comanda'];?>" class="btn btn-dark" style="width: 100%;">Ver itens</a>
                <br><br>
                <a href="https://<?php echo $host;?>/comandas/imprimir/<?php echo $linhas['comanda'];?>" class="btn btn-secondary" style="width: 100%;" target="_blank">Imprimir pedido <i class="fa fa-print"></i></a>
            </div>
            <br>
        </div>
        <?php
        }
        echo '</div>';
    }
}
?>