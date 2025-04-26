
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $resultado_blog['categoria'];?> - <?php echo $resultado_sobre['nome_empresa'];?></title>
    
    <meta content="<?php echo $resultado_blog['categoria'];?>" name="description">
    <meta content="<?php echo $resultado_blog['keywords'];?>" name="keywords">
    <meta name="application-name" content="Plataforma FLY">
    <link rel="canonical" href="https://<?php echo $host;?>/produtos/conteudo/<?php echo $resultado_blog['url'];?>">
    <meta property="og:title" content="<?php echo $resultado_blog['categoria'];?> - <?php echo $resultado_sobre['nome_empresa'];?>" />
    <meta property="og:image" content="https://<?php echo $host;?>/uploads/<?php echo $resultado_blog['file'];?>" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="<?php echo $resultado_blog['categoria'];?>" />
    <meta property="og:url"  content="https://<?php echo $host;?>/blog/conteudo/<?php echo $resultado_blog['url'];?>" />
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
  <?php echo base64_decode($resultado_sobre['adsense']);?>
</head>

<body>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    
    <?php include('app/helpers/user/cadastro/index.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo $resultado_blog['categoria'];?></h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Blog</li>
            <li><?php echo $resultado_blog['categoria'];?></li>
          </ol>
        </div>

      </div>
    </section>
    <div class="container">
        <br>
        <center><?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/retangulo.php');?></center>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
                    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/lateral_direto.php');?>
                <?php } else { ?>
                    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/adsEsquerda.php');?>
                <?php } ?>
                
            </div>
            <div class="col-lg-7">
                <h4><?php echo $resultado_blog['categoria'];?></h4>
                <b style="font-size: 14px; color: grey;"><i class="fa fa-calendar"></i> <?php echo date('d/m/Y H:i', strtotime($resultado_blog['data'].''.$resultado_blog['hora']));?></b>
                <img src="https://<?php echo $host;?>/uploads/<?php echo $resultado_blog['file'];?>" style="width: 100%;">
                <br><br>
                <?php echo $resultado_blog['descricao'];?>
            </div>
            <div class="col-lg-3">
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/lateral_direto.php');?>
                <hr>
                <?php include('blocos/recomendados_direita.php');?>
            </div>
        </div>
        <hr>
        
        
    
    </div>
    <section id="avaliacoes" class="faq section-bg">
              <div class="container">
        
                <div class="section-title">
                  <h2>Mais noticias</h2>
                </div>
        
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/lista_esquerda.php');?>
                
        
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