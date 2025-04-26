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
<style type="text/css">
body{margin-top:20px;}
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
    margin: 1rem
}

@media (min-width:768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.46rem;
        position: absolute;
        left: 7.5rem;
        top: .3125rem
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.8125rem;
        position: absolute;
        right: 7.5rem;
        top: .3125rem
    }
}

.timeline-steps .timeline-content {
    width: 10rem;
    text-align: center
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #3b82f6
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #3b82f6;
    display: inline-block;
    height: 3rem;
    width: 3rem;
    min-width: 3rem;
    border-radius: 6.25rem;
    opacity: .5
}

.timeline-steps .timeline-content .inner-circle-off {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #333333
}

.timeline-steps .timeline-content .inner-circle-off:before {
    content: "";
    background-color: grey;
    display: inline-block;
    height: 3rem;
    width: 3rem;
    min-width: 3rem;
    border-radius: 6.25rem;
    opacity: .5
}
</style>
</head>
<body>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/user/blocos/menu.php');?>
    <br><br><br><br><br>
    <div id="timeline"></div>
    <br>
    <div class="container">
        <?php include('editar.php');?>
    </div>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
// script.js
$(document).ready(function() {
    // Função para fazer o GET dos resultados
    function obterResultados() {
        $.get("https://<?php echo $host;?>/timeline/<?php echo $url[2];?>", function(response) {
            // Atualiza a div com os resultados obtidos
            $("#timeline").html(response);
        });
    }

    // Chama a função para obter resultados ao carregar a página
    obterResultados();

    $(document).on("submit", "#FormAdd", function(e) {
        e.preventDefault(); 
        
        var $form       = $(this); // Captura o formulário específico que foi submetido
        var formId      = $form.data("form-id");
        var NomeItem    = $form.data("item-id");
        var dados       = $form.serialize();
        $.ajax({
            url: "https://<?php echo $host;?>/timeline/update/<?php echo $url[2];?>",
            type: "POST",
            data: dados,
            success: function() {
                Swal.fire(
                  'Status atualizado!',
                  '',
                  'success'
                );
                obterResultados(formId, $form);
            },
            error: function() {
                Swal.fire(
                  'Produto: ' + NomeItem,
                  'Erro, tente novamente',
                  'error'
                );
            }
        });
    });
});
</script>
</html>