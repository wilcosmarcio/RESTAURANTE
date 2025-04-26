<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title;?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
<?php echo base64_decode($resultado_sobre['adsense']);?>
</head>
<body>
    <?php 
    if($validacao == 'ok'){ 
        include('app/layout/'.$resultado_templete_i['templete'].'/user/blocos/menu.php');
    } else {
        include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');
    }
    ?>
   <br>
    <section id="breadcrumbs" class="breadcrumbs" style="background-color: white;">
        <div class="container">
            <a href="https://<?php echo $host;?>/comandas/listagem" class="btn btn-primary rounded-pill py-3 px-5"  style="float: right;">Ver todas comandas</a>
            <br><br>
                <h4 style="color: grey;">Pedidos: </h4>
                <span id="ListagemComandas"></span>
        </div>
    </section>    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script>
    function fazerRequisicao() {
        fetch('https://<?php echo $host;?>/ListagemComandas')
            .then(response => response.text())
            .then(data => {
                document.getElementById('ListagemComandas').innerHTML = data;
            })
            .catch(error => console.error('Erro na requisição:', error));
    }

    // Chama a função inicialmente e a cada 3 segundos
    fazerRequisicao();
    setInterval(fazerRequisicao, 3000); // 3000 milissegundos = 3 segundos
</script>
</html>