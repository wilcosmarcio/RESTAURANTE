<!DOCTYPE html>
<html lang="en">
<?php $obj_mensalidade->gerar_pix();?>
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
            <li>Plano</li>
            <li><?php echo $resultado_blog['categoria'];?></li>
          </ol>
        </div>

      </div>
    </section>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4" style="border: 1px solid #4db6f9; border-radius: 15px; padding: 15px;">
                <span style="color: grey; font-size: 12px;">Total a pagar</span>
                <h4 style="color: #4db6f9;">R$ <?php echo $resultado_dados['total_pagar'];?></h4>
                <hr>
                <center>
                <img style='display:block; width:300px;height:300px;' id='base64image' src='data:image/jpeg;base64, <?php echo $resultado_dados['qrcode_pix'];?>' />
                </center>
                <br>
                <input type="text" id="texto" class="form-control" value="<?php echo $resultado_dados['linha_pix'];?>" readonly>
                <a class='btn btn-primary rounded-pill py-3 px-5' style='width: 100%;' onclick="copiarTexto()">Copiar linha <i class="fa fa-copy"></i></a>
                <hr>
                <center>
                <span style="color: grey; font-size: 15px;">Aponte a camera do seu celular para o qrcode ou copie a linha "copia e cola" para efetuar o pagamento por aplicativo bancario.</span>
                </center>
                <br>
                <center>
                <b style="color: green; font-size: 14px;">Ambiente seguro 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"></path>
                    </svg>
                </b>
                </center>
            </div>
        </div>
    </div>
    <br>
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
<script>
function adicionarMeses() {
    var select = document.getElementById('meses');
    var optionSelecionada = select.options[select.selectedIndex];
    var meses = parseInt(optionSelecionada.value);
    
    if (meses === 0 || meses === "" || meses < 1) {
        document.getElementById('resultado').innerText = "";
        return;
    }
    var preco_desconto = parseFloat(optionSelecionada.getAttribute('data-preco_desconto'));
    var preco = parseFloat(optionSelecionada.getAttribute('data-preco'));
    if (meses > 1) {
        var valor_desconto = preco_desconto * meses;
        var valorFormatadoD = valor_desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        var texto_desconto = "De <s>" + valorFormatadoD + "</s> por ";
    } else {
        var texto_desconto = '';
    }
    var valor = meses * preco;
    var dataAtual = new Date();
    var novaData = new Date(dataAtual.getFullYear(), dataAtual.getMonth() + meses, dataAtual.getDate());
    var dia = novaData.getDate();
    var mes = novaData.getMonth() + 1; // Os meses em JavaScript são baseados em zero, então adicionamos 1 para obter o mês correto
    var ano = novaData.getFullYear();
    
    var dataFormatada = (dia < 10 ? '0' : '') + dia + "/" + (mes < 10 ? '0' : '') + mes + "/" + ano;
    var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    
    
    var resultado = "Próximo vencimento: " + dataFormatada + ". <br>"+texto_desconto+" " + valorFormatado + "<br><br><input type='submit' class='btn btn-primary rounded-pill py-3 px-5' style='width: 100%;' name='BtnPagar' value='Efetuar pagamento'>";
    document.getElementById('resultado').innerHTML = resultado;
}
</script>
<script>
function copiarTexto() {
    /* Seleciona o elemento de entrada de texto */
    var inputElement = document.getElementById("texto");

    /* Seleciona o conteúdo do campo de entrada de texto */
    inputElement.select();

    /* Copia o texto selecionado para a área de transferência */
    document.execCommand("copy");

    /* Deseleciona o campo de entrada de texto */
    inputElement.blur();

    /* Exibe uma mensagem para o usuário */
    alert("Linha do pix copiada!");
}
</script>
</html>