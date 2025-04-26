<?php
		if($url[1] == ""){
			$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);
			$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
		} else {	
			$pagina = $url[1];
		}
	
	
		//Setar a quantidade de itens por pagina
		$qnt_result_pg = 9;
		
		//calcular o inicio visualização
		$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
		
		$sql_cat = mysqli_query($conexao,"SELECT * FROM blog_categoria WHERE url = '".$url[3]."'") or die("Erro");
        $resultado_cat = mysqli_fetch_assoc($sql_cat);
		
		//produtos
		if(isset($url[3])){
			$sql_blog_config = mysqli_query($conexao,"SELECT * FROM blog WHERE categoria_id = '".$resultado_cat['id']."' and cod_data <= '".strtotime(date('Y-m-d H:i'))."' ORDER BY id DESC LIMIT $inicio, $qnt_result_pg") or die("Erro");
		} else {
			$sql_blog_config = mysqli_query($conexao,"SELECT * FROM blog WHERE cod_data <= '".strtotime(date('Y-m-d H:i'))."' ORDER BY id DESC LIMIT $inicio, $qnt_result_pg") or die("Erro");
		}
        
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Artigos - <?php echo $resultado_sobre['nome_empresa'];?></title>
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
  
  <?php echo base64_decode($resultado_sobre['adsense']);?>
</head>

<body>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2><?php if($resultado_cat['nome'] <> ''){ echo $resultado_cat['nome']; } else { echo 'Blog'; }?></h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Blog</li>
            <?php if($resultado_cat['nome'] <> ''){ echo '<li>'.$resultado_cat['nome'].'</li>'; }?>
          </ol>
        </div>

      </div>
    </section>
    
    <div class="container">
        <br>
        <center><?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/ads/adsterra/retangulo.php');?></center>
    </div>
    
    <div class="container">
        <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
            <?php include('blocos/mobile/listagem.php');?>
        <?php } else { ?>
            <?php include('blocos/listagem.php');?>
        <?php } ?>
        <br><br><br>
        <?php include('blocos/paginacao.php');?>
    </div>
    
    <div class="container">
        <br>
        <?php $object_ads->retangulo_rodape();?>
        <br><br>
    </div>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    
</body>

</html>