<!--Tag notification Firebase-->
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
    import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-messaging.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-analytics.js";

    const firebaseConfig = {
        apiKey: "AIzaSyATMhjIpB7DHo49Hc7TAXzvc7nh-tmnY1U",
        authDomain: "kifomi-d05b0.firebaseapp.com",
        projectId: "kifomi-d05b0",
        storageBucket: "kifomi-d05b0.appspot.com",
        messagingSenderId: "1010627929931",
        appId: "1:1010627929931:web:875437c406ffcfe72e2ace"
    };

    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    const messaging = getMessaging(app);
    
    navigator.serviceWorker.register("sw.js").then(registration => {
            getToken(messaging, {
                serviceWorkerRegistration: registration,
                vapidKey: 'BMpq3_csR-xPfcpbYPmQqYxisuj6ODyNdHZs4aBwllyjFGzithIbH_EV_cjPX6e7leUqUhdIu0p2TCYWsTH3fQI' }).then((currentToken) => {
                if (currentToken) {
                    console.log("Token is: "+currentToken);
                    $.post("/user/token_notification", {
                        token:currentToken
                    },
                    function(retorno){
                        
                    }
                    )
                } else {
                   
                }
            }).catch((err) => {
                
            });
        });
</script>

<link href="https://<?php echo $host;?>/app/layout/<?php echo $resultado_templete_i['templete'];?>/assets/css/modal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
?>
<div id="myModal-sair" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <b>Realmente deseja sair?</b>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <a href="https://<?php echo $host;?>/sair" style="width: 100%;" class="btn btn-danger">Sim, quero sair</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-success" data-dismiss="modal" style="width: 100%;">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar Janela</button>
            </div>
        </div>
                
    </div>
</div>
<?php if($status_plano == '1'){ ?>
    <div id="topbar" style="background-color: #dc3545;" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
          <div class="align-items-center d-none d-md-flex">
            Atenção, encontramos uma mensalidade em atraso.
          </div>
        </div>
    </div>
<?php }?>
<?php if($status_plano == '2'){ ?>
    <div id="topbar" style="background-color: #ffc107;" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
          <div class="align-items-center d-none d-md-flex">
            Sua mensalidade vence hoje!
          </div>
        </div>
    </div>
<?php }?>
<?php if($status_plano == ''){ ?>
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
          <div class="align-items-center d-none d-md-flex">
            <?php if($validacao == 'ok'){ ?>
                Bem vindo (a), <?php echo $nome_user;?>!
            <?php } ?>
          </div>
        </div>
    </div>
<?php }?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="https://<?php echo $host;?>/dashboard" class="logo me-auto"><img src="https://<?php echo $host;?>/uploads/logo/logo.png" alt=""></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="https://<?php echo $host;?>/dashboard">Home</a></li>
          
          <li class="dropdown"><a href="#"><span>Produtos</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="https://<?php echo $host;?>/produtos">Gerenciar produtos</a> </li>
                <li><a href="https://<?php echo $host;?>/categorias">Categorias</a> </li>
                <li><a href="https://<?php echo $host;?>/adicionais">Adicionais</a> </li>
                <li><a href="https://<?php echo $host;?>/variacoes">Variações</a> </li>
            </ul>
          </li>
          
          <li class="dropdown"><a href="#"><span>Configurações</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="https://<?php echo $host;?>/user">Meu Cardápio</a></li>
                <li><a href="https://<?php echo $host;?>/mesas">Mesas</a></li>
                <li><a href="https://<?php echo $host;?>/user/horarios">Horarios de funcionamento</a></li>
                <li><a href="https://<?php echo $host;?>/user/sobre">Sobré nós</a></li>
                <li><a href="https://<?php echo $host;?>/user/logo">logo</a></li>
                <li><a href="https://<?php echo $host;?>/user/banner">Banner</a></li>
                <li><a href="https://<?php echo $host;?>/user/dados">Dados da empresa</a></li>
                <?php if($plano == '1'){ ?>
                    <li><a href="https://<?php echo $host;?>/user/config">Configurar WhatsApp</a></li>
                <?php } ?>
                <li><a href="https://<?php echo $host;?>/user/config_seo">Configurar SEO</a></li>
                <?php if($plano == '1' || $plano == '3'){ ?>
                    <?php if($principal == '1'){ ?>
                        <li><a href="https://<?php echo $host;?>/user/usuarios">Usuários</a></li>
                    <?php } ?>
                    <li><a href="https://<?php echo $host;?>/user/FaixaCep">Faixa de Cep</a></li>
                <?php } ?>
            </ul>
          </li>
          <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
            <li><a href="https://<?php echo $host;?>/plano" >Plano</a></li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      
        <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
            <?php if($validacao == 'ok'){ ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto"><i class="fa fa-user"></i></a>
                <?php if($plano == '1' || $plano == '3'){ ?>
                <a href="https://<?php echo $host;?>/comandas" class="appointment-btn scrollto">Comandas <span id="comandasbipe"></span></a>
                <?php } ?>
            <?php } else { ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto"><i class="fa fa-user"></i> / <i class="fas fa-file-signature"></i></a>
            <?php }?>
        <?php } else { ?>
            <?php if($validacao == 'ok'){ ?>
                <?php if($plano == '1' || $plano == '3'){ ?>
                <a href="https://<?php echo $host;?>/comandas" class="appointment-btn scrollto">Comandas <span id="comandasbipe"></span></a>
                <?php } ?>
                <a href="https://<?php echo $host;?>/plano" class="appointment-btn scrollto">Plano</a>
                <a data-toggle="modal" data-target="#myModal-sair" class="appointment-btn scrollto" style="cursor: pointer;">Sair</a>
            <?php } else { ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto">Entre / Cadastre-se</a>
            <?php }?>
        <?php } ?>
    </div>
  </header>
<?php if($plano == '1' || $plano == '3'){ ?>
<script>
    function fazerRequisicao() {
        fetch('https://<?php echo $host;?>/comandas/bipe')
            .then(response => response.text())
            .then(data => {
                document.getElementById('comandasbipe').innerHTML = data;
            })
            .catch(error => console.error('Erro na requisição:', error));
    }

    // Chama a função inicialmente e a cada 3 segundos
    fazerRequisicao();
    setInterval(fazerRequisicao, 5000); // 3000 milissegundos = 3 segundos
</script>
<?php }?>