<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pagamento</title>
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
  
  <!-- MODAL -->
  <link rel="stylesheet" href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/css/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  
</head>

<body>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensagem!</h4>
      </div>
      <div class="modal-body">
        <p>O download ficará disponível quando o intermediador de pagamentos nos notificar que o status foi alterado para aprovado.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar janela</button>
      </div>
    </div>

  </div>
</div>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Pedidos</h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Pedidos</li>
            <li><?php echo $pedido_id;?></li>
          </ol>
        </div>

      </div>
    </section>
<br>
    <!-- Contact Start -->
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Total</h6>
                <h1 class="display-6 mb-4">R$ <?php echo number_format($valor_total,2,",",".");?></h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?php if($pedido_status == '1'){ ?>
                        <?php $object_pagamento->$codigo_modulo();?>
                        
                        <?php if($copia_pix <> ''){?>
                            <img style='display:block; width:350px;height:350px;' id='base64image' src='data:image/jpeg;base64, <?php echo $qrcode_pix;?>' />
    
                            <b>Copie:</b>
                            <textarea class="form-control" style="height: 90px;" readonly><?php echo $copia_pix;?></textarea>
                            
                        <?php } ?>
                    <?php }?>
                
                    <?php if($pedido_status == '2'){ ?>
                        <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/pedido/blocos/aprovado.php');?>
                    <?php } ?>
                    <br><br>
                </div>
                <div class="col-lg-6">
                    <center><h6 class="section-title bg-white text-center text-primary px-3">Produtos</h6></center>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Preço</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($linhas_agendamentos=mysqli_fetch_assoc($sql_items)){ ?>
                            <?php
                                $sql_download_item = mysqli_query($conexao,"select * from cadastrofeed WHERE id = '".$linhas_agendamentos['id_item']."'") or die("Erro");
	                            $resultado_download_item = mysqli_fetch_assoc($sql_download_item);
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $linhas_agendamentos['titulo'];?>
                                        <br><b><a href="https://<?php echo $host;?>/produtos/conteudo/<?php echo $resultado_download_item['url'];?>#avaliacoes" target="_BLANK">Clique aqui para avaliar <i class="fa fa-star"></i></a></b>
                                    </th>
                                    <th><?php echo number_format($linhas_agendamentos['preco'],2,",",".");?></th>
                                    <th>
                                    <?php if($linhas_agendamentos['preco'] > '0'){ ?>
                                        <?php if($pedido_status == '2'){ ?>
                                            <a href="https://<?php echo $host;?>/baixar.php/?id=<?php echo $pedido_id;?>&permissao=<?php echo $linhas_agendamentos['codigo_download'];?>&file=<?php echo $resultado_download_item['file'];?>" class="btn btn-primary" download>Baixar <i class="fa fa-download"></i></a>
                                        <?php } else { ?>
                                            <button class="btn btn-black" data-toggle="modal" data-target="#myModal">Baixar <i class="fa fa-download"></i></button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <a href="https://<?php echo $host;?>/baixar.php/?id=<?php echo $pedido_id;?>&permissao=<?php echo $linhas_agendamentos['codigo_download'];?>&file=<?php echo $resultado_download_item['file'];?>" class="btn btn-primary" download>Baixar <i class="fa fa-download"></i></a>
                                    <?php } ?>
                                    </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table class="table">
                    <tr> 
                        <td><b>SubTotal:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($totalPagamento,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Desconto:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($totalDesconto,2,",",".");?></td>
                    </tr>
                    <tr> 
                        <td><b>Valor total:</b></td>
                        <td></td>
                        <td></td>
                        <td>R$ <?php echo number_format($valor_total,2,",",".");?></td>
                    </tr>
                </table>
                    
                    <b>Status: <?php echo $status;?></b>
                </div>
            </div>
            <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/button_youtube.php');?>
        </div>
        
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/wow/wow.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/easing/easing.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/counterup/counterup.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo $resultado_dados['certificado'];?>://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/js/main.js"></script>
</body>

</html>