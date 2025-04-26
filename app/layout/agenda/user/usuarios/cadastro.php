<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title?></title>
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
  <script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/js/maskReal.js"></script>
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
    <?php include('app/helpers/user/cadastro/index.php');?>
   <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Dados</h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Home</li>
          </ol>
        </div>

      </div>
    </section>
    <?php $object_Usuarios->cadastro();?>
    <br>
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                        <label for="subject">Nome</label>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="login" placeholder="Login"required>
                        <label for="subject">Login</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                        <label for="subject">Senha</label>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-4">
                    <div class="form-floating">
                        <button class="btn btn-primary rounded-pill py-3 px-5" name="btn_usuarios" type="submit">Cadastrar faixa de cep</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <br>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>

</html>