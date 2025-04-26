<?php 
$sql_imgogg = mysqli_query($conexao,"SELECT * FROM imagem_produto WHERE codigo_produto = '".$resultado_blog['codigo']."' ORDER BY 'id'") or die("Erro");
$resultado_imgogg = mysqli_fetch_assoc($sql_imgogg);

$sql_aval = mysqli_query($conexao,"SELECT * FROM avaliacoes WHERE id_item = '".$resultado_blog['id']."'") or die("Erro");

$sql_star = mysqli_query($conexao,"SELECT sum(estrelas) FROM avaliacoes WHERE id_item = '".$resultado_blog['id']."'") or die("Erro");
$total_star = mysqli_num_rows($sql_star);
                    
while($linhas_star=mysqli_fetch_assoc($sql_star)){
    $contar_estrelas = $linhas_star['sum(estrelas)'];
}

$sql_avaliacoes     = mysqli_query($conexao,"SELECT * FROM avaliacoes WHERE id_item = '".$resultado_blog['id']."'") or die("Erro");
$total_avaliacoes   = mysqli_num_rows($sql_avaliacoes);

//JA COMPROU
$sql_jaComprou          = mysqli_query($conexao,"SELECT * FROM pedido_lista WHERE id_item = '".$resultado_blog['id']."' and user_id = '".$id_user."'") or die("Erro");
$total_jaComprou        = mysqli_num_rows($sql_jaComprou);
$resultado_jaComprou    = mysqli_fetch_assoc($sql_jaComprou);

$sql_PjaComprou         = mysqli_query($conexao,"SELECT * FROM pedidos WHERE id = '".$resultado_jaComprou['pedido_id']."' and user_id = '".$id_user."' and status = '2'") or die("Erro");
$resultado_PjaComprou   = mysqli_fetch_assoc($sql_PjaComprou);


if($contar_estrelas > 0){
    $totalmedia = $contar_estrelas / $total_avaliacoes;
} else {
    $totalmedia = '0';
}

$avaliacoes = mysqli_query($conexao,"SELECT * FROM avaliacoes WHERE id_item = '".$resultado_blog['id']."'");
$total_avaliacoes = mysqli_num_rows($avaliacoes);
                    
$totalmedias = $contar_estrelas / $total_avaliacoes;
                    
$i = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $resultado_blog['categoria'];?> - <?php echo $resultado_sobre['nome_empresa'];?></title>
    
    <meta content="<?php echo $resultado_blog['descricao'];?>" name="description">
    <meta content="<?php echo $resultado_blog['busca'];?>" name="keywords">
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
  
  <!-- Stars -->
  <link rel="stylesheet" href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/css/star.css">
  
  <?php echo base64_decode($resultado_sobre['adsense']);?>
</head>

<body>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    
    <?php include('app/helpers/user/cadastro/index.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
<?php $object_item->avaliar();?>
        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo $resultado_blog['categoria'];?></h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Produto</li>
            <li><?php echo $resultado_blog['categoria'];?></li>
          </ol>
        </div>

      </div>
    </section>
    <br>
    <center><?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/retangulo.php');?></center>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if($resultado_blog['link'] <> ''){ ?>
                <iframe width="100%" height="450px" src="https://www.youtube.com/embed/<?php echo $resultado_blog['link'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <?php } ?>
                <br>
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/produtos/conteudo/blocos/slid.php');?>
                
            </div>
            <div class="col-lg-4">
                <h4><?php echo $resultado_blog['categoria'];?></h4>
                <hr>
                <?php echo $resultado_blog['descricao'];?>
                <hr>
                <h3>R$ <?php echo number_format($resultado_blog['preco'],2,",",".");?></h3>
                <p>Download imediato após aprovação do pagamento (PIX) <i class="fa fa-fash"></i> <i class="fa fa-download"></i></p>
                <hr>
                <?php if($total_downloads > 0){ ?><b style="color: grey; font-size: 14px;">Downloads: <?php echo $total_downloads;?></b><br><?php } ?>
                
                <a href="#avaliacoes">
                <b style="color: grey;">Avaliações</b><br>
                <?php
                    while ($i < $totalmedias) {
                        echo '<i class="fa fa-star" style="color: #fde16d;"></i>';
                        $i++;
                    }
                    if(ceil($totalmedia) == 5) {
                        $data[$k]['continua'] .= '';
                    } else {
                        $continua = 5 - $totalmedia;
                        $var = 0;
                        while ($var < $continua) {
                            echo '<i class="fa fa-star" style="color: #ccc;"></i>';      
                            $var++;
                        }
                    }
                ?>
                </a>
                <br>
                <?php if($validacao == 'ok'){ ?>
                    <?php if($total_jaComprou > 0){ ?>
                        <br>
                        <b>Voçê tem um pedido com esse produto.</b>
                        <a href="https://<?php echo $host;?>/user/pedido/<?php echo $resultado_jaComprou['pedido_id'];?>" class="btn btn-primary" style="width: 100%;">Ver pedido</a>
                    <?php } else { ?>
                        <br>
                        <a href="https://<?php echo $host;?>/checkout/acao/somar/<?php echo $resultado_blog['id'];?>" class="btn btn-primary" style="width: 100%;">Comprar agora</a>
                    <?php } ?>
                <?php } else { ?>
                <b style="color: grey; font-size: 15px;">Para fazer o download voçê precisa estar logado.</b>
                    <a href="https://<?php echo $host;?>/user" class="btn btn-primary" style="width: 100%;">Entrar / Cadastre-se</a>
                <?php } ?>
                
                <hr>
                <h4>Dúvidas?</h4>
                <p>Mande um direct no Instagram.</p>
                <a class="btn btn-warning " style="border: 0; color: white;" href="https://www.instagram.com/maycon_bragaa/" role="button">Ir para Instagram <i class="fa fa-instagram"></i></a>
                <br><br>
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/button_youtube.php');?>
                <hr>
                <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/lateral_direto.php');?>
            </div>
        </div>
        <hr>
        
        
    
    </div>
    


<?php include('app/layout/'.$resultado_templete_i['templete'].'/produtos/conteudo/blocos/modal.php');?>
    <section id="avaliacoes" class="faq section-bg">
              <div class="container">
                <?php if($resultado_PjaComprou['id'] == ''){ ?>  
                    <b>Voçê só pode avaliar após comprar o produto.</b>
                <?php } else { ?>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Avaliar produto <i class="fa fa-star"></i></a>
                <?php } ?>
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