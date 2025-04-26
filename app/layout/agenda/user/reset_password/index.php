
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Redefinir senha - <?php echo $resultado_sobre['nome_empresa'];?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
</head>

<body>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Redefinir Senha</h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Home</li>
            <li>Redefinir Senha</li>
          </ol>
        </div>

      </div>
    </section>
    
    <div class="container">
        <?php if($nova_senha <> 'ok'){ ?>
            <?php if($validacao == 'ok'){ ?>
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/dados.php');?>
            <?php } else { ?>
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/blocos/form.php');?>
            <?php  } ?>
        <?php } else { ?>
            <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/reset_password/blocos/nova_senha.php');?>
        <?php } ?>
    </div>
        
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    
</body>

</html>