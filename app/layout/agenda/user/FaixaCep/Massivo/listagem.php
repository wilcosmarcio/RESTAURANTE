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
        <h4>Encontre os bairros de uma determinada cidade</h4>
        <input type="text" class="form-control" id="search-input" placeholder="Qual cidade?">
        <div id="loading-message" style="display: none;">Carregando página...</div>
        <div id="mensagem-processando" style="display:none;">Processando...</div>
        <form id="frete-form">
            <div id="content"></div>
        </form>
    </div>
    <br>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById("search-input");

    searchInput.addEventListener("input", function() {
        var searchTerm = searchInput.value.trim();
        if (searchTerm !== "") {
            var url = "https://<?php echo $host;?>/FaixaCep/listagem/" + encodeURIComponent(searchTerm);
            loadPage(url);
        } else {
            // Se o campo de busca estiver vazio, limpa o conteúdo da área de conteúdo
            document.getElementById("content").innerHTML = "";
            document.getElementById("loading-message").style.display = "none"; // Esconde a mensagem de carregamento
        }
    });

    function loadPage(url) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById("content").innerHTML = xhr.responseText;
                    document.getElementById("loading-message").style.display = "none"; // Esconde a mensagem de carregamento
                } else {
                    // Tratar erros, se necessário
                    console.error("Erro ao carregar página: " + xhr.status);
                }
            }
        };

        xhr.open("GET", url, true);
        xhr.send();
        document.getElementById("loading-message").style.display = "block"; // Mostra a mensagem de carregamento
    }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#frete-form').submit(function(e){
        e.preventDefault(); // Impede o envio padrão do formulário

        // Mostra a mensagem de "Processando"
        $('#mensagem-processando').show();

        // Serializa os dados do formulário
        var formData = $(this).serialize();

        // Envia os dados do formulário via AJAX
        $.ajax({
            type: 'POST',
            url: 'https://<?php echo $host;?>/cadFaixaCEP',
            data: formData,
            dataType: 'json', // Espera um retorno em JSON
            success: function(response){
                // Esconde a mensagem de "Processando"
                $('#mensagem-processando').hide();
                
                // Se o retorno for 'ok', exibe uma mensagem de sucesso
                if(response.status === 'ok') {
                    alert('Frete gravado com sucesso!');
                } else {
                    alert('Ocorreu um erro ao gravar o frete.');
                }
            },
            error: function(xhr, status, error){
                // Esconde a mensagem de "Processando" e exibe uma mensagem de erro
                $('#mensagem-processando').hide();
                alert('Ocorreu um erro ao gravar o frete: ' + error);
            }
        });
    });
});
</script>
</html>