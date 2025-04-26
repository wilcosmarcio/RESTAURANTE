
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Checkout</title>
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
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Checkout</h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Checkout</li>
          </ol>
        </div>

      </div>
    </section>
    <br>
    
    <div class="container">
        <?php if($total <> ''){ ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Qtde</th>
                </tr>
            </thead>
            <tbody>
                <?php include('app/helpers/carrinho/json.php');?>
            </tbody>
            
        </table>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <b><?php echo $nome_user;?> <br> <?php echo $telefone_user;?></b>
                <hr>
                <b>Endereço de cadastro:</b>
                <br>
                <?php echo $rua_user;?>, <?php echo $numero_user;?>, <?php echo $bairro_user;?> - <?php echo $cidade_user;?>-<?php echo $uf_user;?>
            </div>
            
            <div class="col-lg-6">
                <table class="table">
                    <tr> 
                        <td><b>SubTotal:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($valorTotal,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Desconto:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($descontoCheckout,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Valor total:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($totalDesconto,2,",",".");?></td>
                    </tr>
                </table>
                <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/checkout/finalizar" class="btn btn-primary" style="width: 100%;">Finalizar pedido R$ <?php echo number_format($totalDesconto,2,",",".");?></a>
            </div>
        </div>
        <?php } else { ?>
            <b>Carrinho vazio</b>
            <br><br>
            <a href="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>" class="btn btn-primary"><< Voltar para vitrine</a>
        <?php } ?>
    </div>
        
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    
</body>

</html>