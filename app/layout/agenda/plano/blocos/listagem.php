<table class="table">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Título</th>
            <th>Categoria</th>
            <th>Preço venda</th>
            <th>Estoque</th>
            <th>Remover</th>
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
            <td><a data-toggle="modal" data-target="#myModal-<?php echo $linhas_produtos['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>