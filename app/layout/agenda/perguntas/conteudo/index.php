
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $resultado_blog['titulo'];?> -  <?php if($resultado_blog['resolvido'] == '1'){ echo '[RESOLVIDO]';} else { echo 'Perguntas'; }?></title>
    
    <meta content="<?php echo $resultado_blog['pergunta'];?>" name="description">
    <meta content="<?php echo $resultado_blog['pergunta'];?>" name="keywords">
    <meta name="application-name" content="Plataforma FLY">
    <link rel="canonical" href="https://<?php echo $host;?>/produtos/conteudo/<?php echo $resultado_blog['url'];?>">
    <meta property="og:title" content="<?php echo $resultado_blog['categoria'];?> - <?php echo $resultado_sobre['nome_empresa'];?>" />
    <meta property="og:image" content="https://<?php echo $host;?>/uploads/<?php echo $resultado_imgogg['file'];?>" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="<?php echo $resultado_blog['descricao'];?>" />
    <meta property="og:url"  content="https://<?php echo $host;?>/produtos/conteudo/<?php echo $resultado_blog['url'];?>" />
    <meta name="author" content="<?php echo $resultado_sobre['nome_empresa'];?>">    

  <!-- Favicons -->
  <link rel="shortcut icon" type="icon" href="/uploads/<?php echo $resultado_logo['file'];?>"/>
  <link href="/uploads/<?php echo $resultado_logo['file'];?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/css/style.css" rel="stylesheet">
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- MODAL -->
  <link rel="stylesheet" href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/css/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <?php echo base64_decode($resultado_sobre['adsense']);?>
</head>

<body>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/perguntas/conteudo/blocos/modal1.php');?>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>

    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
<?php $object_ask->resolvido();?>
<?php $object_ask->responder();?>
        <div class="d-flex justify-content-between align-items-center">
          <?php if($id_user == $resultado_blog['user_id']){ ?>
            <?php if($resultado_blog['resolvido'] == '1'){ $resolvido = 'success';  } else { $resolvido = 'danger'; } ?>
                <form action="" method="POST">
                    <button type="submit" class="btn btn-<?php echo $resolvido;?>" name="btnUpdate">Meu problema foi resolvido <i class="fa fa-check"></i></button>
                </form>
            <?php } else { ?>
                <?php if($resultado_blog['resolvido'] == '1'){ echo '<h2 style="color: green;"> Resolvido';  } else { echo '<h2 style="color: red;"> Não resolvido'; } ?></h2>
            <?php } ?>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Perguntas</li>
            <li><?php echo $resultado_blog['titulo'];?></li>
          </ol>
        </div>

      </div>
    </section>
    <div class="container">
        <br>
        <?php $object_ads->retangulo_topo();?>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <b style="float: right; color: grey;"><i class="fa fa-user"></i> <?php echo $resultado_userAsk['nome'];?></b>
                <h4><?php echo $resultado_blog['titulo'];?></h4> 
                <b style="color: grey;"><i class="fa fa-calendar"></i> <?php echo date('d/m/Y H:i', strtotime($resultado_blog['data']));?></b>
                <hr>
                <?php if($validacao == 'ok'){ ?>
                    <a  style="float: right; cursor: pointer;" data-toggle="modal" data-target="#myModal-ask1"><i class="fa fa-comments"></i> Responder</a>
                <?php } ?>
                <p><?php echo $resultado_blog['pergunta'];?></p>
                <hr>
                <h4>Respostas:</h4>
                <br>
                <?php while($linhas_respostas = mysqli_fetch_assoc($sql_respostas)){ ?>
                    <?php
                        $sql_user_resposta = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE id = '".$linhas_respostas['user_id']."'") or die("Erro");
                        $resultado_user_resposta = mysqli_fetch_assoc($sql_user_resposta);
                    ?>
                    
                    <b style="float: right; color: grey;"><i class="fa fa-user"></i> <?php echo $resultado_userAsk['nome'];?></b>
                    <p><?php echo $linhas_respostas['resposta'];?></p> 
                    <b style="color: grey;"><i class="fa fa-calendar"></i> <?php echo date('d/m/Y H:i', strtotime($linhas_respostas['data']));?></b>
                    <hr>
                <?php } ?>
            </div>
            <div class="col-lg-2">
                <?php $object_ads->interna_direita();?>
            </div>
        </div>
        <hr>
        
        
    
    </div>
    <section id="avaliacoes" class="faq section-bg">
              <div class="container">
        
                <div class="section-title">
                  <h2>Avaliações</h2>
                  <p>Veja oque outros dev's estão dizendo sobre esse script.</p>
                </div>
        
                <div >
                  <div>
                        <?php while($linhas_star=mysqli_fetch_assoc($sql_aval)){ ?>
                        <?php
                            $sql_aval_user = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE id = '".$linhas_star['id_user']."' LIMIT 1") or die("Erro");
                            $resultado_aval_user = mysqli_fetch_assoc($sql_aval_user);
                        ?>

                        
                            <b><?php echo $resultado_aval_user['nome'];?> - <?php echo $linhas_star['data'];?></b>
                            <p>
                                
                            <?php
                                $ii = 0;
                                while ($ii < $linhas_star['estrelas']) {
                                    echo '<i class="fa fa-star" style="color: #fde16d;"></i>';
                                    $ii++;
                                }
                                if(ceil($linhas_star['estrelas']) == 5) {
                                    $data[$k]['continua'] .= '';
                                } else {
                                    $continua = 5 - $linhas_star['estrelas'];
                                    $var = 0;
                                    while ($var < $continua) {
                                        echo '<i class="fa fa-star" style="color: #ccc;"></i>';      
                                        $var++;
                                    }
                                }
                            ?>
                            </p>
                            <p><?php echo $linhas_star['comentario'];?></p>
                            <hr>
                        <?php } ?>
                  </div>
                </div>
        
              </div>
        </section>
    
    <div class="container">
        <br>
        <?php $object_ads->retangulo_rodape();?>
        <br><br>
    </div>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    </body>

</html>