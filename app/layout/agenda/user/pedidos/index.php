<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pedidos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
          <h2>Pedidos</h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Pedidos</li>
          </ol>
        </div>

      </div>
    </section>
<br>
    <!-- Contact Start -->
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-4">Meus Pedidos</h1>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <?php while($linhas_pedidos = mysqli_fetch_assoc($sql_pedidos)){ ?>
                        <?php if($linhas_pedidos['status'] == '1'){ $cor_status = 'warning'; } if($linhas_pedidos['status'] == '2'){ $cor_status = 'success'; } if($linhas_pedidos['status'] == '3'){ $cor_status = 'danger'; } ?>
                        <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/user/pedido/<?php echo $linhas_pedidos['id'];?>" class="btn btn-<?php echo $cor_status;?>" style="width: 100%;"><?php echo $linhas_pedidos['data'];?> - Pedido: <?php echo $linhas_pedidos['id'];?></a><br><br>
                    <?php } ?>
                </div>
                <div class="col-lg-3"></div>
            </div>
            
        </div>
        
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    
</body>

</html>