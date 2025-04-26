<section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Ultimos artigos</h2>
        </div>

        <div class="row">
            <?php while($linhas_artigos = mysqli_fetch_assoc($sql_artigos)){ ?>
            <?php 
                $sql_categoria = mysqli_query($conexao,"SELECT * FROM blog_categoria WHERE id = '".$linhas_artigos['categoria_id']."' ORDER BY 'id'") or die("Erro");
	            $resultado_categoria = mysqli_fetch_assoc($sql_categoria);
	        ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" >
              
            <div class="member" style="width: 100%;">
                <span style="background-color: green; color: white; float: left; padding: 2px;"><?php echo $resultado_categoria['nome'];?></span>
                <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/blog/conteudo/'.$linhas_artigos['url'];?>">
                    <div style="background-image: url('https://<?php echo $host;?>/uploads/<?php echo $linhas_artigos['file'];?>'); background-size: 100%; height: 290px; background-repeat: no-repeat;"></div>
                </a>
              
              <a href="<?php echo $resultado_dados['certificado'].'://'.$host.'/blog/conteudo/'.$linhas_artigos['url'];?>">
              <div style="height: 55px;">
                <div style="height: 45px;">
                    <h5 style="font-size: 31px;"><?php echo $linhas_artigos['categoria'];?></h5>
                </div>
                <br>
                <span style="color: grey;"><?php echo date('d/m/Y H:i', strtotime($linhas_artigos['data'].''.$linhas_artigos['hora']));?></span>
              </div>
              </a>
              <br><br>
            </div>
            
          </div>
          <br><br>
        <?php } ?>
          

        </div>

      </div>
    </section>
    
        
            






























