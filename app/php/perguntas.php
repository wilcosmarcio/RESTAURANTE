<?php
//VIEWS
include('app/helpers/views/class.views.php');
$object_views = new views;
$object_views->geral();
?>
<?php
include('app/helpers/ads/class.ads.php');
$object_ads = new ads;

    include('urls.php');
    
    include('app/helpers/perguntas/class.perguntas.php');
    $object_ask = new perguntas;
    
    
		
    if($url[0] == "perguntas"){
        if($url[2] == "busca"){
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/perguntas/index.php';
        }
        
        if($url[1] == "conteudo"){
            $sql_blog           = mysqli_query($conexao,"SELECT * FROM ask  WHERE url = '".$url2."' ") or die("Erro");
            $resultado_blog     = mysqli_fetch_assoc($sql_blog);
            
            $sql_userAsk        = mysqli_query($conexao,"SELECT * FROM usuario_agenda  WHERE id = '".$resultado_blog['user_id']."' ") or die("Erro");
            $resultado_userAsk  = mysqli_fetch_assoc($sql_userAsk);
            
            $sql_respostas      = mysqli_query($conexao,"SELECT * FROM ask_respostas WHERE status = '1' and ask_id = '".$resultado_blog['id']."' ORDER BY id DESC") or die("Erro");
            
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/perguntas/conteudo/index.php';
        } else {
            //Busca
            if(isset($_POST['btnBusca'])){
                echo "<script> window.location.href='https://".$host."/perguntas/1/busca/".$busca."'; </script>";
            }
            require_once 'app/layout/'.$resultado_templete_i['templete'].'/perguntas/index.php';
        }
    }
?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
