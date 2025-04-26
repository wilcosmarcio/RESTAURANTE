<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
?>

<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-smile"></i> Cardápio virtual completo <i class="fa fa-file"></i>
      </div>
      <div class="d-flex align-items-center">
        Fica pronto em poucos minutos <i class="fa fa-flash"></i>
      </div>
    </div>
</div>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="https://<?php echo $host;?>" class="logo me-auto"><img src="https://<?php echo $host;?>/uploads/logo/logo.png" style="width: 100%;" alt=""></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="https://<?php echo $host;?>">Home</a></li>
          <li><a class="nav-link scrollto" href="https://<?php echo $host;?>/#ferramentas">Ferramentas</a></li>
          <li><a class="nav-link scrollto" href="https://app.kifomi.com.br" target="_blank">Clientes</a></li>
          <li><a class="nav-link scrollto" href="#planos">Planos</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      
        <?php if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { ?>
            <?php if($validacao == 'ok'){ ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto"><i class="fa fa-user"></i></a>
            <?php } else { ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto"><i class="fa fa-user"></i> / <i class="fas fa-file-signature"></i></a>
            <?php }?>
        <?php } else { ?>
            <?php if($validacao == 'ok'){ ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto">Bem vindo (a), <?php echo $nome_user;?>!</a>
            <?php } else { ?>
                <a href="https://<?php echo $host;?>/user" class="appointment-btn scrollto">Entre / Cadastre-se</a>
            <?php }?>
        <?php } ?>
    </div>
  </header>