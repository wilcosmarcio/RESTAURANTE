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
    
    
    <?php include('app/helpers/user/cadastro/index.php');?>
    
    <?php $object_loja->abertura();?>
   <br>
    <section id="breadcrumbs" class="breadcrumbs" style="background-color: white;">
        <div class="container">
            <form action="" method="POST">
                <?php if($resultado_sobre['abertura'] == ''){ ?>
                    <div class="row" style="float: right; width: 400px;">
                        <h3>
                            <?php
                            $dia_da_semana = date("N");
                            if ($dia_da_semana == 1) {
                                echo "Segunda-feira";
                            }
                            if ($dia_da_semana == 2) {
                                echo "Terça-feira";
                            }
                            if ($dia_da_semana == 3) {
                                echo "Quarta-feira";
                            }
                            if ($dia_da_semana == 4) {
                                echo "Quinta-feira";
                            }
                            if ($dia_da_semana == 5) {
                                echo "Sexta-feira";
                            }
                            if ($dia_da_semana == 6) {
                                echo "Sábado";
                            }
                            if ($dia_da_semana == 7) {
                                echo "Domingo";
                            }
                            ?>
                        </h3>
                        <div class="col-lg-6">
                            <span>Abertura</span>
                            <input type="text" class="form-control" name="abertura" value="<?php echo $resultado_sobreConfig['abertura'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                        </div>
                        <div class="col-lg-6">
                            <span>Fechamento</span>
                            <input type="text" class="form-control" name="fechamento" value="<?php echo $resultado_sobreConfig['fechamento'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                        </div>
                        <div class="col-lg-12"><br></div>
                        <div class="col-lg-12">
                            <span>Tempo de entrega em minutos</span>
                            <input type="text" class="form-control" name="tempo_entrega" value="<?php echo $resultado_sobreConfig['tempo_entrega'];?>" id="horaInput" maxlength="5" oninput="formatarHora(this)">
                        </div>
                        <div class="col-lg-12"><br></div>
                        <div class="col-lg-12">
                            <button class="btn btn-success rounded-pill py-3 px-5" name="btnAbrir" style="float: right; width: 100%;">Abrir restaurante</button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row" style="float: right; width: 400px;">
                        <div class="col-lg-6">
                            <span>Abertura</span>
                            <input type="text" class="form-control" value="<?php echo $resultado_sobreConfig['abertura'];?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <span>Fechamento</span>
                            <input type="text" class="form-control"  value="<?php echo $resultado_sobreConfig['fechamento'];?>" disabled>
                        </div>
                        <div class="col-lg-12"><br></div>
                        <div class="col-lg-12">
                            <span>Tempo de entrega em minutos</span>
                            <input type="text" class="form-control" name="tempo_entrega" value="<?php echo $resultado_sobreConfig['tempo_entrega'];?>">
                            <br>
                            <button class="btn btn-success rounded-pill py-3 px-5" name="btnAtualizar" style="float: right; width: 100%;">Atualizar tempo de entrega</button>
                        </div>
                        <div class="col-lg-12"><br></div>
                        <div class="col-lg-12">
                            <button class="btn btn-danger rounded-pill py-3 px-5" name="btnFechar" style="float: right; width: 100%;">Fechar restaurante</button>
                        </div>
                    </div>
                <?php } ?>
            </form>
            
            <div class="row">
                <div class="col-lg-12"><hr></div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="border: 1px solid grey; border-radius: 25px; padding: 25px; margin: 2px;">
                <h4 style="color: #4db6f9;"><?php $obj_financeiro->qtde_aberta();?></h4>
                <b>Abertos</b>
            </div>
            <div class="col-lg-2" style="border: 1px solid grey; border-radius: 25px; padding: 25px; margin: 2px;">
                <h4 style="color: #4db6f9;"><?php $obj_financeiro->qtde_preparando();?></h4>
                <b>Preparando</b>
            </div>
            <div class="col-lg-3" style="border: 1px solid grey; border-radius: 25px; padding: 25px; margin: 2px;">
                <h4 style="color: #4db6f9;"><?php $obj_financeiro->qtde_entregando();?></h4>
                <b>Saiu para entrega</b>
            </div>
            <div class="col-lg-2" style="border: 1px solid grey; border-radius: 25px; padding: 25px; margin: 2px;">
                <h4 style="color: #4db6f9;"><?php $obj_financeiro->qtde_finalizado();?></h4>
                <b>Finalizados</b>
            </div>
            <div class="col-lg-2" style="border: 1px solid grey; border-radius: 25px; padding: 25px; margin: 2px;">
                <h4 style="color: #4db6f9;"><?php $obj_financeiro->qtde_cancelado();?></h4>
                <b>Cancelados</b>
            </div>
        </div>
    </div>
    <br>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script>
function formatarHora(input) {
    var cleaned = input.value.replace(/\D/g, '');
    if (cleaned.length > 2) {
        cleaned = cleaned.substring(0, 2) + ':' + cleaned.substring(2);
    }
    input.value = cleaned;
}
</script>
</html>