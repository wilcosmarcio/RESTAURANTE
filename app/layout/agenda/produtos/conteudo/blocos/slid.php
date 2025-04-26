<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<div id="demo" class="carousel slide" data-ride="carousel" style="width: 100%;">
    <div class="carousel-inner" style="border-radius: 5px; box-shadow: 0 0 9px 1px; height: 500px;">
        
        <?php while($linhas_img_produtos = mysqli_fetch_array($sql_img_produto)){ ?>
        <?php 
        $sql_img = mysqli_query($conexao,"SELECT * FROM imagem_produto WHERE id_empresa = '".$resultado_dados['id']."' and codigo_produto = '".$resultado_blog['codigo']."' ORDER BY id DESC LIMIT 1") or die("Erro");
        $resultado_img = mysqli_fetch_assoc($sql_img);
        ?>
            <?php if($resultado_img['id'] == $linhas_img_produtos['id']){ ?>
                <div class="carousel-item active">
                    <img src="https://<?php echo $host;?>/uploads/<?php echo $linhas_img_produtos['file'];?>" style="width:100%;">
                </div>
            <?php } else { ?>
                <div class="carousel-item">
                    <img src="https://<?php echo $host;?>/uploads/<?php echo $linhas_img_produtos['file'];?>" style="width:100%;">
                </div>
            <?php } ?>
        <?php } ?>
      
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>			     