<section id="team" class="team section-bg">
      <div class="container">

        

        
            <?php while($linhas_catDestaque=mysqli_fetch_assoc($sql_catDestaque)){ ?> 
            <?php $sql_produtos = mysqli_query($conexao,"SELECT * FROM cadastrofeed WHERE codigo_categoria = '".$linhas_catDestaque['codigo']."' and id_empresa = '".$resultado_dados['id']."' and destaque = '1' ORDER BY id ASC LIMIT 6") or die("Erro"); ?>
                <div class="section-title">
                  <h2><?php echo $linhas_catDestaque['titulo'];?></h2>
                </div>
                
                <div class="row">
                <?php while($linhas_produtos=mysqli_fetch_assoc($sql_produtos)){ ?> 
                    <?php include('form_destaque.php');?>
                    <?php include('app/helpers/produtos/config_listagem.php'); ?>
                      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" >
                          
                        <div class="member" style="width: 100%;">
                            
                            <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/produtos/conteudo/'.$linhas_produtos['url'];?>">
                                <div style="background-image: url('https://<?php echo $host;?>/uploads/<?php echo $img_principal;?>'); background-size: 100%; height: 290px; background-repeat: no-repeat;"></div>
                            </a>
                          <span style="background-color: green; color: white; float: right; padding: 3px; border-radius: 3px; margin: 2px;"><?php echo $resultado_categoria['titulo'];?> <i class="fa fa-tag"></i></span>
                            <br>
                            <?php
                                while ($i < $totalmedias) {
                                    echo '<i class="fa fa-star" style="color: #fde16d;"></i>';
                                    $i++;
                                }
                                if(ceil($totalmedia) == 5) {
                                    $data[$k]['continua'] .= '';
                                } else {
                                    $continua = 5 - $totalmedia;
                                    $var = 0;
                                    while ($var < $continua) {
                                        echo '<i class="fa fa-star" style="color: #ccc;"></i>';      
                                        $var++;
                                    }
                                }
                            ?>
                          <br>
                          
                          <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/produtos/conteudo/'.$linhas_produtos['url'];?>">
                          <div style="height: 55px;">
                          <h5><?php echo $linhas_produtos['categoria'];?></h5>
                          <span><?php echo $linhas_produtos['n_botao'];?></span>
                          </div>
                          </a>
                          <div id="results-destaque-<?php echo $linhas_produtos['id'];?>"></div>
                            <?php if($validacao == 'ok'){ ?>
                                <span>Pre&ccedil;o: <br><b style="color: green; font-size: 19px;">R$<?php echo number_format($linhas_produtos['preco'],2,",",".");?></b></span>
                            <?php } else { ?>
                                <span>Pre&ccedil;o: <br><b style="color: green; font-size: 19px;">R$<?php echo number_format($linhas_produtos['preco'],2,",",".");?></b></span>
                                <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/user" class="btn btn-primary" style="width: 100%;" href="">Entrar</a>
                            <?php } ?>
                            <b style="float: right; color: grey;">Downloads: <?php echo $total_downloads;?></b>
                            <br><br>
                        </div>
                        
                      </div>
                      <br><br>
            <?php } ?>
            </div>
            <br>
        <?php } ?>
        
        

      </div>
    </section>