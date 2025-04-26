<?php while($linhas_recomendados=mysqli_fetch_assoc($sql_recomendados_direita)){ ?>
    <?php 
        $sql_categoria = mysqli_query($conexao,"SELECT * FROM blog_categoria WHERE id = '".$linhas_recomendados['categoria_id']."' ORDER BY 'id'") or die("Erro");
        $resultado_categoria = mysqli_fetch_assoc($sql_categoria);
    ?>
    <div class="row">
        <div class="col-lg-3">
                <img src="https://<?php echo $host;?>/uploads/<?php echo $linhas_recomendados['file'];?>" style="width: 100%;">
        </div>
        <div class="col-lg-9">
            <a href="https://<?php echo $host;?>/blog/conteudo/<?php echo $linhas_recomendados['url'];?>">
                <span style="color: white; background-color: green; padding: 3px; font-size: 12px; float: right;"><?php echo $resultado_categoria['nome'];?></span>
                <h4 style="font-size: 19px;"><?php echo $linhas_recomendados['categoria'];?></h4>
                <b style="color: grey;"><?php echo date('d/m/Y H:i', strtotime($linhas_recomendados['data'].''.$linhas_recomendados['hora']));?></b>
            </a>
        </div>
    </div>
    <hr>
<?php } ?>