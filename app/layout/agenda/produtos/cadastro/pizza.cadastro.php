
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
<?php echo $object_item->AdicionarProduto();?>
        <br><br>
<div class="row">
    <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">    
        <div class="container">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="btn btn-primary" href="#home" style="margin: 4px;">Dados</a></li>
            <li><a data-toggle="tab" class="btn btn-primary" href="#menu1" style="margin: 4px;">Preços</a></li>
          </ul>
            <br><br>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <h4>Novo produto - Pizza</h4>
                                    </div>
                                    <div class="col-6">
                                                <div class="form-floating">
                                                    <div class="btn-group">
                                                        <input type="radio" class="btn-check" name="dois_sabores" id="dois_sabores1" value="2" autocomplete="off"  />
                                                        <label class="btn btn-success" for="dois_sabores1">Sim</label>
                                                        
                                                        <input type="radio" class="btn-check" name="dois_sabores" id="dois_sabores2" value="" autocomplete="off" checked />
                                                        <label class="btn btn-success" for="dois_sabores2">Não</label>
                                                    </div>
                                                </div>
                                                <label for="subject">Dois sabores</label>
                                    </div> 
                                    <input type="hidden" name="pizza" value="1">
                                    <div class="col-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="titulo" placeholder="Título" required>
                                            <label for="subject">Título</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="ean" placeholder="Código EAN" required>
                                            <label for="subject">Código EAN</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-control" name="categoria" required>
                                                <?php $sql_categoriaPizza      = mysqli_query($conexao,"SELECT * FROM categoria_produtos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."' and url = 'pizza'") or die("Erro2"); ?>
                                                <?php while($linhas_categoriaPizza = mysqli_fetch_assoc($sql_categoriaPizza)){ ?>
                                                    <option value="<?php echo $linhas_categoriaPizza['id'];?>"><?php echo $linhas_categoriaPizza['titulo'];?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="subject">Categoria</label>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-12">
                                        <textarea class="form-control" name="descricao" style="width: 100%; height: 200px;" placeholder="Ex: Produtos frescos e de primeira qualidade"></textarea>
                                    </div> 
                                    
                                    <div class="col-12"><hr></div>
                                    
                                    <b style="color: grey;">Adicionais</b>
                                    <?php while($linhas_Adicional = mysqli_fetch_assoc($sql_Adicional)){ ?>
                                        <div class="col-1">
                                            <label style="cursor: pointer;"><input type="checkbox" value="<?php echo $linhas_Adicional['id'];?>" onclick="addOrRemoveValue(this)"> <?php echo $linhas_Adicional['titulo'];?></label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-12">
                                        <textarea class="form-control" name="adicionais" style="width: 100%; height: 120px;" id="myTextarea" readonly></textarea>
                                    </div>
                                    <div class="col-12">
                                        <b style="color: grey;">Foto do produto</b>
                                        <input type="file" class="form-control" name="imagem" required/>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <div class="btn-group">
                                                <input type="radio" class="btn-check" name="status" id="option1" value="2" autocomplete="off"  />
                                                <label class="btn btn-success" for="option1">Ativo</label>
                                                
                                                <input type="radio" class="btn-check" name="status" id="option2" value="1" autocomplete="off" checked />
                                                <label class="btn btn-success" for="option2">Inativo</label>
                                            </div>
                                        </div>
                                        <label for="subject">Status</label>
                                    </div>
                                    <div class="col-6">
                                                <div class="form-floating">
                                                    <div class="btn-group">
                                                        <input type="radio" class="btn-check" name="destaque" id="destaque1" value="2" autocomplete="off"  />
                                                        <label class="btn btn-success" for="destaque1">Ativo</label>
                                                        
                                                        <input type="radio" class="btn-check" name="destaque" id="destaque2" value="1" autocomplete="off" checked />
                                                        <label class="btn btn-success" for="destaque2">Inativo</label>
                                                    </div>
                                                </div>
                                                <label for="subject">Destaque</label>
                                    </div>    
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary rounded-pill py-3 px-5" name="btn_AddProduto" type="submit">Enviar produto</button>
                                    </div>
                                </div>
                        
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="row g-3">
                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="preco_venda" placeholder="Título" onKeyPress="return(myfunction(this,'','.',event))" required>
                                            <label for="subject">Preço de venda</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="preco_custo" placeholder="Título" onKeyPress="return(myfunction(this,'','.',event))" required>
                                            <label for="subject">Preço de custo</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="estoque" placeholder="Título" required>
                                            <label for="subject">Estoque</label>
                                        </div>
                                    </div>
                </div>
            </div>
            
          </div>
        </div>
    </form>   
</div>


<script>
function addOrRemoveValue(checkbox) {
  var textarea = document.getElementById("myTextarea");
  var currentValue = textarea.value;
  var checkboxValue = checkbox.value;

  if (checkbox.checked) {
    // Adiciona o valor do checkbox ao textarea se ainda não estiver lá
    if (currentValue.indexOf(checkboxValue) === -1) {
      textarea.value += checkboxValue + ", ";
    }
  } else {
    // Remove o valor do checkbox do textarea se ele estiver lá
    if (currentValue.indexOf(checkboxValue) !== -1) {
      textarea.value = currentValue.replace(checkboxValue + ", ", "");
      // Se o valor estava no início do textarea, remover a quebra de linha adicional
      if (textarea.value.indexOf(", ") === 0) {
        textarea.value = textarea.value.substring(1);
      }
    }
  }
}

</script>









    </div>
        
    <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
    

</body>

</html>