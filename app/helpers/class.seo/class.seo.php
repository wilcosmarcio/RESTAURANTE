<?php
class Seo{
    function update(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btn_seo'])){
            $categorias             = str_replace($array_post, '', $_POST['categorias']);
            
            $update = "UPDATE clientes SET
                categorias  = '".$categorias."'
            WHERE id = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/config_seo'>";
        }
    }
}