<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
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
  <script src="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/js/maskReal.js"></script>
  <?php echo base64_decode($resultado_sobre['adsense']);?>
</head>

<body>
    
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/blocos/menu.php');?>
    <br>
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo $resultado_blog['categoria'];?></h2>
          <ol>
            <li><a href="https://<?php echo $host;?>">Home</a></li>
            <li>Produtos</li>
            <li><?php echo $resultado_blog['categoria'];?></li>
          </ol>
        </div>

      </div>
    </section>
    <br>
    <div class="container">
        <a href="https://<?php echo $host;?>/produtos/novo" class="btn btn-primary rounded-pill py-3 px-5" >Novo cadastro</a>
        <a href="https://<?php echo $host;?>/produtos/massivo" class="btn btn-success rounded-pill py-3 px-5" >Cadastro em massa</a>
        <br><br>
        <div class="container">
            <input type="text" id="termoBusca" class="form-control" placeholder="Buscar produto">
            <br><br>
            <center><div id="mensagemCarregando">Carregando a pagina, favor aguarde...</div></center>
            <span id="resultado"></span>
        </div>
        <br>
    </div>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script>
            function fazerRequisicao(pagina, termoBusca = '') {
                // Exibindo mensagem de "carregando"
                document.getElementById('mensagemCarregando').style.display = 'block';
                // Substituir espaços por hífens
                termoBusca = termoBusca.replace(/\s+/g, '-');
                // Faz a requisição para a página específica
                let url = `https://<?php echo $host;?>/produtos/api-listagem/${pagina}`;
                if (termoBusca !== '') {
                    url += `/busca/${termoBusca}`;
                }
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        // Removendo mensagem de "carregando" quando os dados são recebidos
                        document.getElementById('mensagemCarregando').style.display = 'none';
                        document.getElementById('resultado').innerHTML = data;
                    })
                    .catch(error => {
                        // Lidando com erros
                        document.getElementById('mensagemCarregando').innerText = 'Erro ao carregar. Por favor, tente novamente mais tarde.';
                        console.error('Erro na requisição:', error);
                    });
            }
    
            // Função para buscar produtos enquanto digita
            document.getElementById('termoBusca').addEventListener('input', function() {
                const termoBusca = this.value;
                fazerRequisicao(1, termoBusca);
            });
    
            // Chamada inicial para carregar os produtos na página
            fazerRequisicao(1);
</script>
</html>