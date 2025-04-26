
<div class="container">
    
<br><br>
    <div class="row">
        <div class="col-lg-2">
            <?php $object_ads->interna_esquerda();?>
        </div>
        <div class="col-lg-8">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="busca" placeholder="Pesquisar">
                    </div>
                    <div class="col-lg-2">
                        <input type="submit" class="btn btn-primary" name="btnBusca" value="Pesquisar">
                    </div>
                </div>
            </form>
            <br><br>
            <?php while($linhas_artigos = mysqli_fetch_assoc($sql_blog_config)){ ?>
            <?php
                $sql_user = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE id = '".$linhas_artigos['user_id']."'") or die("Erro");
                $resultado_user = mysqli_fetch_assoc($sql_user);
                
                $sql_respostas = mysqli_query($conexao,"SELECT * FROM ask_respostas WHERE ask_id = '".$linhas_artigos['id']."'") or die("Erro");
                $total_respostas = mysqli_num_rows($sql_respostas);
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php if($linhas_artigos['resolvido'] == '1') { ?>
                            <span style="float: right; background-color: green; color: white; padding: 2px; border-radius: 4px;">Resolvido <i class="fa fa-check"></i></span>
                        <?php } ?>
                        <a href="https://<?php echo $host;?>/perguntas/conteudo/<?php echo $linhas_artigos['url'];?>">
                            <h5 style="font-size: 17px;"><?php echo $linhas_artigos['titulo'];?></h5>
                        </a>
                        <p><i class="fa fa-user"></i> <?php echo $resultado_user['nome'];?></p>
                        <a href="https://<?php echo $host;?>/perguntas/conteudo/<?php echo $linhas_artigos['url'];?>">
                            <i class="fa fa-comments"></i> <?php echo $total_respostas;?> <?php if($total_respostas > '1'){ echo 'Respostas'; } else { echo 'Resposta'; }?> 
                        </a>
                        <span style="float: right; color: grey;"><i class="fa fa-calendar"></i> <?php echo date('d/m/Y H:i', strtotime($linhas_artigos['data']));?></span>
                        
                    </div>
                    <div class="col-lg-12"><hr></div>
                </div>
            <?php } ?>
        </div>
        <div class="col-lg-2">
            <?php $object_ads->interna_direita();?>
        </div>

    </div>

</div>