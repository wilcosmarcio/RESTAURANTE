<div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Destaques</h6>
            </div>
            <div class="row" style="border: 1px solid grey; border-radius: 5px; padding: 5px;">
                <?php while($linhas_produtos=mysqli_fetch_assoc($sql_produtos)){ ?> 
                <?php include('app/layout/agenda/blocos/produtos/form_destaque.php');?>
                <?php include('app/helpers/produtos/config_listagem.php'); ?>
                
                
                <div class="col-12"><br></div>
                    <div class="col-6">
                        <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/produtos/conteudo/'.$linhas_produtos['url'];?>">
                            <div style="background-image: url('https://<?php echo $host;?>/uploads/<?php echo $img_principal;?>'); background-size: 100%; height: 150px; background-repeat: no-repeat;"></div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="team-title">
                            <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/produtos/conteudo/'.$linhas_produtos['url'];?>">
                                <h5 style="font-size: 17px;"><?php echo $linhas_produtos['categoria'];?></h5>
                            </a>
                        </div>
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
                        <div id="results-destaque-<?php echo $linhas_produtos['id'];?>"></div>
                                <div class="team-social">
                                    <?php if($validacao == 'ok'){ ?>
                                        <span>Pre&ccedil;o: <br><b style="color: green; font-size: 19px;">R$<?php echo number_format($linhas_produtos['preco'],2,",",".");?></b></span>
                                    <?php } else { ?>
                                        <span>Pre&ccedil;o: <br><b style="color: green; font-size: 19px;">R$<?php echo number_format($linhas_produtos['preco'],2,",",".");?></b></span>
                                        <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/user" class="btn btn-primary" style="width: 100%;" href="">Entrar</a>
                                    <?php } ?>
                                </div>
                                <br>
                        <span style="background-color: green; color: white; float: right; padding: 2px; border-radius: 3px;"><?php echo $resultado_categoria['titulo'];?> <i class="fa fa-tag"></i></span>    
                    </div>
                    <div class="col-12"><hr></div>
                <?php } ?>
            </div>
        </div>
    </div>