<?php
if($url[3] == 'busca'){
    $sql_item_config = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' ") or die("Erro1");
    $total_sql  = mysqli_num_rows($sql_item_config);
    $totalRegistros     = $total_sql;
    $registrosPorPagina = '20';
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    
    $paginaAtual = isset($url[2]) ? $url[2] : 1;
    
    $offset = ($paginaAtual - 1) * $registrosPorPagina;
    
    $sql_blog_config = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and titulo LIKE '%".str_replace('-', ' ', $url[4])."%'") or die("Erro1");
        
    $sql_cat = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro3");
    $resultado_cat = mysqli_fetch_assoc($sql_cat);
} else {
    $sql_item_config = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro1");
    $total_sql  = mysqli_num_rows($sql_item_config);
    $totalRegistros     = $total_sql;
    $registrosPorPagina = '20';
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    
    $paginaAtual = isset($url[2]) ? $url[2] : 1;
    
    $offset = ($paginaAtual - 1) * $registrosPorPagina;
    
    $sql_blog_config = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' ORDER BY id DESC LIMIT $offset, $registrosPorPagina") or die("Erro1");
        
    $sql_cat = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro3");
    $resultado_cat = mysqli_fetch_assoc($sql_cat);
}
?>
<table class="table">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Título</th>
            <th>Categoria</th>
            <th>Preço venda</th>
            <th>Estoque</th>
            <th>funções</th>
        </tr>
    </thead>
    <tbody>
    <?php while($linhas_produtos=mysqli_fetch_assoc($sql_blog_config)){ ?> 
    <?php
        $sql_categoria = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE id = '".$linhas_produtos['categoria']."'") or die("Erro3");
        $resultado_categoria = mysqli_fetch_assoc($sql_categoria);
    ?>
    <div id="myModal-<?php echo $linhas_produtos['id'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <b>Deseja remover: <?php echo $linhas_produtos['titulo'];?>?</b>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="https://<?php echo $host;?>/produtos/remover/<?php echo $linhas_produtos['id'];?>" style="width: 100%;" class="btn btn-danger">Remover <i class="fa fa-trash"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                </div>
            </div>
                    
        </div>
    </div>
    <div id="myModal-copy-<?php echo $linhas_produtos['id'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <b>Deseja fazer uma cópia de: <?php echo $linhas_produtos['titulo'];?>?</b>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="https://<?php echo $host;?>/produtos/duplicar/<?php echo $linhas_produtos['id'];?>" style="width: 100%;" class="btn btn-success">Criar uma cópia <i class="fa fa-copy"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
                </div>
            </div>
                    
        </div>
    </div>
    <?php 
        if($linhas_produtos['file'] == ''){
            $imagem = '<img src="https://'.$host.'/uploads/sem_foto/sem_foto.jpeg" style="60px; height: 60px;">';
        } else {
            $imagem = '<img src="'.$linhas_produtos['file'].'" style="60px; height: 60px;">';
        }
    ?>
    
        <tr>
            <td><a href="https://<?php echo $host;?>/produtos/editar/<?php echo $linhas_produtos['id'];?>"><?php echo $imagem;?></a></td>
            <td><a href="https://<?php echo $host;?>/produtos/editar/<?php echo $linhas_produtos['id'];?>"><?php echo $linhas_produtos['titulo'];?></a></td>
            <td><a href="https://<?php echo $host;?>/produtos/editar/<?php echo $linhas_produtos['id'];?>"><?php echo $resultado_categoria['titulo'];?></a></td>
            <td><a href="https://<?php echo $host;?>/produtos/editar/<?php echo $linhas_produtos['id'];?>"><?php echo $linhas_produtos['preco_venda'];?></a></td>
            <td><a href="https://<?php echo $host;?>/produtos/editar/<?php echo $linhas_produtos['id'];?>"><?php echo $linhas_produtos['estoque'];?></a></td>
            <td>
                <a data-toggle="modal" data-target="#myModal-copy-<?php echo $linhas_produtos['id'];?>" class="btn btn-primary"><i class="fa fa-copy"></i></a>
                <a data-toggle="modal" data-target="#myModal-<?php echo $linhas_produtos['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
if($url[3] <> 'busca'){
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
?>