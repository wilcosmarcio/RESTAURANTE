<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<?php include('app/layout/'.$resultado_templete_i['templete'].'/head.php');?>
<body>
<?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/menu.php');?>
<br><br><br>
<?php 
if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
    echo '<br><br><br>';
} else {
    include('app/layout/'.$resultado_templete_i['templete'].'/blocos/slide.php');
}
?>
  <main id="main">
    <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
        
        <div class="container">
            <div class="row" id="ferramentas">
                <div class="col-lg-7">
                    <img src="https://kifomi.com.br/app/layout/agenda/assets/img/foto1.png" style="width: 100%;">
                </div>
                <div class="col-lg-5 pt-4 pt-lg-0 content">
                    <br><br><br>
                    <h3 style="font-weight: 600;
        font-size: 26px;">Como podemos te ajudar?</h3>
                    <br>
                    <b>
                    <i class="bi bi-check-circle" style="color: green;"></i> Cardapio virtual.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Notificação via WhatsApp <i class="fa fa-whatsapp"></i>.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Web delivery.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Faixa de cep.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> QRCODE para mesas.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Produto simples.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Produto com variação.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Adicionais.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Controle de comandas.
                    <br>
                    <hr>
                    <br>
                    <a href="https://kifomi.com.br/#planos" style="background-color: #66cc66; color: white; padding: 15px; border: 0; width: 100%;">Montar meu cardapio</a>
                    </b>
                    <br>
                </div>
            </div>
        </div>
        <br>
        <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/apresentacao.php');?>
    <?php } else { ?>
        <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/apresentacao.php');?>
        <div class="container">
            <div class="row" id="ferramentas">
                <div class="col-lg-7">
                    <img src="https://kifomi.com.br/app/layout/agenda/assets/img/foto1.png" style="width: 100%;">
                </div>
                <div class="col-lg-5 pt-4 pt-lg-0 content">
                    <br><br><br>
                    <h3 style="font-weight: 600;
        font-size: 26px;">Como podemos te ajudar?</h3>
                    <br>
                    <b>
                    <i class="bi bi-check-circle" style="color: green;"></i> Cardapio virtual.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Notificação via WhatsApp <i class="fa fa-whatsapp"></i>.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Web delivery.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Faixa de cep.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> QRCODE para mesas.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Produto simples.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Produto com variação.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Adicionais.
                    <br><br>
                    <i class="bi bi-check-circle" style="color: green;"></i> Controle de comandas.
                    <br>
                    <hr>
                    <br>
                    <a href="https://kifomi.com.br/#planos" style="background-color: #66cc66; color: white; padding: 15px; border: 0; width: 100%;">Montar meu cardapio</a>
                    </b>
                </div>
            </div>
        </div>
    <?php  } ?>
    <div class="container-fluid" id="planos" style="background-color: #4db6f9; padding: 50px;">
        <center>
            <h1 style="color: white;">Planos</h1>
            <b style="color: white;">Crie seu cardápio em poucos minutos agora mesmo.</b>
        </center>
        <div class="row" style="padding: 5px;">
            <div class="col-lg-2"></div>
            <?php while($linhas = mysqli_fetch_assoc($sql_planos)){ ?>
                <?php if($linhas['id'] == '1'){ ?>
                    <div class="col-lg-3" style="background-color: white; margin: 2px; padding: 15px;">
                        <center>
                            <span style="margin: 0 0 18px 0;">
                            <h3 style="font-weight: 600; font-size: 26px; "><?php echo $linhas['plano'];?></h3>
                            </span>
                        </center>
                        <hr>
                        <br>
                        <?php if($linhas['id'] == '1'){ ?>
                            <i class="bi bi-check-circle" style="color: green;"></i> Cardapio virtual.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Notificação via WhatsApp <i class="fa fa-whatsapp"></i>.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> QRCODE para mesas.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto simples.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto com variação.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Adicionais.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Anuncios.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Teste 7 dias grátis.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Faixa de cep.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Web delivery.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Controle de comandas.
                            <br><br>
                            <h3 style="color:  #4db6f9;">R$ <?php echo $linhas['valor'];?><b style="font-size: 12px;">/mês</b></h3>
                            <a href="https://kifomi.com.br/user/plano/<?php echo $linhas['codigo_plano'];?>" class="btn btn-primary rounded-pill py-3 px-5" style="width: 100%;">Criar cardápio</a>
                        <?php } ?>
                        <br>
                    </div>
                <?php } ?>
                <?php if($linhas['id'] == '2'){ ?>
                    <div class="col-lg-3" style="background-color: white; margin: 2px; padding: 15px;">
                        <center>
                            <span style="margin: 0 0 18px 0;">
                            <h3 style="font-weight: 600; font-size: 26px; "><?php echo $linhas['plano'];?></h3>
                            </span>
                        </center>
                        <br>
                        <hr>
                        <br>
                        <?php if($linhas['id'] == '2'){ ?>
                            <i class="bi bi-check-circle" style="color: green;"></i> Cardapio virtual.
                            <br><br>
                            <i class="fa fa-remove" style="color: red;"></i> Notificação via WhatsApp <i class="fa fa-whatsapp"></i>.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> QRCODE para mesas.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto simples.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto com variação.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Adicionais.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Anuncios.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Teste 7 dias grátis.
                            <br><br>
                            <i class="fa fa-remove" style="color: red;"></i> Faixa de cep.
                            <br><br>
                            <i class="fa fa-remove" style="color: red;"></i> Web delivery.
                            <br><br>
                            <i class="fa fa-remove" style="color: red;"></i> Controle de comandas.
                            <br><br>
                            <h3 style="color:  #4db6f9;">R$ <?php echo $linhas['valor'];?><b style="font-size: 12px;">/mês</b></h3>
                            <a href="https://kifomi.com.br/user/plano/<?php echo $linhas['codigo_plano'];?>" class="btn btn-primary rounded-pill py-3 px-5" style="width: 100%;">Criar cardápio</a>
                        <?php } ?>
                        <br>
                    </div>
                <?php } ?>
                <?php if($linhas['id'] == '3'){ ?>
                    <div class="col-lg-3" style="background-color: white; margin: 2px; padding: 15px;">
                        <center>
                            <span style="margin: 0 0 18px 0;">
                            <h3 style="font-weight: 600; font-size: 26px; "><?php echo $linhas['plano'];?></h3>
                            </span>
                        </center>
                        <br>
                        <hr>
                        <br>
                        <?php if($linhas['id'] == '3'){ ?>
                            <i class="bi bi-check-circle" style="color: green;"></i> Cardapio virtual.
                            <br><br>
                            <i class="fa fa-remove" style="color: red;"></i> Notificação via WhatsApp <i class="fa fa-whatsapp"></i>.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> QRCODE para mesas.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto simples.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Produto com variação.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Adicionais.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Anuncios.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Teste 7 dias grátis.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Faixa de cep.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Web delivery.
                            <br><br>
                            <i class="bi bi-check-circle" style="color: green;"></i> Controle de comandas.
                            <br><br>
                            <h3 style="color:  #4db6f9;">R$ <?php echo $linhas['valor'];?><b style="font-size: 12px;">/mês</b></h3>
                            <a href="https://kifomi.com.br/user/plano/<?php echo $linhas['codigo_plano'];?>" class="btn btn-primary rounded-pill py-3 px-5" style="width: 100%;">Criar cardápio</a>
                        <?php } ?>
                        <br>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
  </main>
  <a href="https://api.whatsapp.com/send?phone=5514991382758&text=Olá, gostaria de mais informações sobre o cardápio virtual." style="position: fixed;
    bottom: 110px;
    right: 20px; width: 60px; height: 60px; border-radius: 50%; z-index: 2147483647;" class="btn btn-success" data-toggle="tooltip" data-placement="left" title="" target="_BLANK" data-original-title="Entre em contato conosco"><i class="fa fa-whatsapp" style="font-size: 40px; margin: 5px 0 0 0;"></i></a>
  <?php include('app/layout/'.$resultado_templete_i['templete'].'/blocos/rodape.php');?>
</body>
</html>