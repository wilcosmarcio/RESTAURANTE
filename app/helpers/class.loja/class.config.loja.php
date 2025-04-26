<?php 
class ConfigLoja{
    function abertura(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btnAbrir'])){
            $abertura       = str_replace($array_post, '', $_POST['abertura']);
            $fechamento     = str_replace($array_post, '', $_POST['fechamento']);
            $tempo_entrega  = str_replace($array_post, '', $_POST['tempo_entrega']);
            $dia_da_semana  = date("N");
            if ($dia_da_semana == 1) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_seg    = '".$abertura."',
                    fechamento_seg  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 2) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_ter    = '".$abertura."',
                    fechamento_ter  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 3) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_qua    = '".$abertura."',
                    fechamento_qua  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 4) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_qui    = '".$abertura."',
                    fechamento_qui  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 5) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_sex    = '".$abertura."',
                    fechamento_sex  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 6) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_sab    = '".$abertura."',
                    fechamento_sab  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            if ($dia_da_semana == 7) {
                $update = "UPDATE sobrenos SET
                    abertura        = '1',
                    abertura_dom    = '".$abertura."',
                    fechamento_dom  = '".$fechamento."',
                    tempo_entrega   = '".$tempo_entrega."'
                    WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
            }
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/dashboard'>";
	    }
	    
	    if(isset($_POST['btnAtualizar'])){
	        $tempo_entrega  = str_replace($array_post, '', $_POST['tempo_entrega']);
	        $update = "UPDATE sobrenos SET
                tempo_entrega   = '".$tempo_entrega."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/dashboard'>";
	    }
	    
	    if(isset($_POST['btnFechar'])){
	        $update = "UPDATE sobrenos SET
                abertura   = ''
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/dashboard'>";
	    }
    }
}