<?php
class Usuarios{
    function update(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btnatualizar'])){
            $id             = str_replace($array_post, '', $_POST['id']);
            $nome           = str_replace($array_post, '', $_POST['nome']);
            $login          = str_replace($array_post, '', $_POST['login']);
            $senha          = $_POST['senha'];
            $encriptPass    = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
            
            $update = "UPDATE usuario_agenda SET
                nome    = '".$nome."',
                login   = '".$login."',
                senha   = '".$encriptPass."'
            WHERE id = '".$id."' and codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'";
            mysqli_query($conexao, $update);
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/usuarios'>";
        }
    }
    function cadastro(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        if(isset($_POST['btn_usuarios'])){
            $nome   = str_replace($array_post, '', $_POST['nome']);
            $login  = str_replace($array_post, '', $_POST['login']);
            $senha  = $_POST['senha'];
            $encriptPass = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
            
            if($senha <> ''){
                $sql_catPizza="INSERT INTO usuario_agenda (
                    nome,
                    login,
                    senha,
                    codigo_loja,
                    id_loja
                ) VALUES (
                    '".$nome."',
                    '".$login."',
                    '".$encriptPass."',
                    '".$codigo_loja."',
                    '".$id_loja."'
                )";
                mysqli_query($conexao, $sql_catPizza);
            }
            
            if($senha == ''){
                $sql_catPizza="INSERT INTO usuario_agenda (
                    nome,
                    login,
                    codigo_loja,
                    id_loja
                ) VALUES (
                    '".$nome."',
                    '".$login."',
                    '".$codigo_loja."',
                    '".$id_loja."'
                )";
                mysqli_query($conexao, $sql_catPizza);
            }
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/usuarios'>";
	    }
    }
}