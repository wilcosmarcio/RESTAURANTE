<?php 
class dadosLoja{
    function horarios(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));

        if(isset($_POST['BtnHorarios'])){
            $abertura_dom = str_replace($array_post, '', $_POST['abertura_dom']);
            $abertura_seg = str_replace($array_post, '', $_POST['abertura_seg']);
            $abertura_ter = str_replace($array_post, '', $_POST['abertura_ter']);
            $abertura_qua = str_replace($array_post, '', $_POST['abertura_qua']);
            $abertura_qui = str_replace($array_post, '', $_POST['abertura_qui']);
            $abertura_sex = str_replace($array_post, '', $_POST['abertura_sex']);
            $abertura_sab = str_replace($array_post, '', $_POST['abertura_sab']);
            $fechamento_dom = str_replace($array_post, '', $_POST['fechamento_dom']);
            $fechamento_seg = str_replace($array_post, '', $_POST['fechamento_seg']);
            $fechamento_ter = str_replace($array_post, '', $_POST['fechamento_ter']);
            $fechamento_qua = str_replace($array_post, '', $_POST['fechamento_qua']);
            $fechamento_qui = str_replace($array_post, '', $_POST['fechamento_qui']);
            $fechamento_sex = str_replace($array_post, '', $_POST['fechamento_sex']);
            $fechamento_sab = str_replace($array_post, '', $_POST['fechamento_sab']);
            
	        $update = "UPDATE sobrenos SET
                abertura_dom    = '".$abertura_dom."',
                abertura_seg    = '".$abertura_seg."',
                abertura_ter    = '".$abertura_ter."',
                abertura_qua    = '".$abertura_qua."',
                abertura_qui    = '".$abertura_qui."',
                abertura_sex    = '".$abertura_sex."',
                abertura_sab    = '".$abertura_sab."',
                fechamento_dom  = '".$fechamento_dom."',
                fechamento_seg  = '".$fechamento_seg."',
                fechamento_ter  = '".$fechamento_ter."',
                fechamento_qua  = '".$fechamento_qua."',
                fechamento_qui  = '".$fechamento_qui."',
                fechamento_sex  = '".$fechamento_sex."',
                fechamento_sab  = '".$fechamento_sab."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/horarios'>";
	    }
    }
    
    function AtualizarBanner() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        include('app/db_configuracao/urlAmigavel.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        
        if(isset($_POST['BtnEditarBanner'])){
            $sql_logo = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'") or die("Erro");
            $resultado_logo	= mysqli_fetch_assoc($sql_logo);
			$local  =   "uploads/banner/".$resultado_logo['banner'];
			array_map('unlink', glob($local));
			
            $file = md5(rand(1000,100000)."-".$_FILES['imagem']['name']);
            $file_loc   = $_FILES['imagem']['tmp_name'];
            $file_size    = $_FILES['imagem']['size'];
            $file_type    = $_FILES['imagem']['type'];
            $folder       ="uploads/banner/"; 
            
            // new file size in KB
            $new_size = $file_size/1024;  
            // new file size in KB
          
            // make file name in lower case
            $new_file_name = strtolower($file);
            // make file name in lower case
          
            $final_file=str_replace(' ','-',$new_file_name);
            
            if(move_uploaded_file($file_loc,$folder.$final_file)){
                
                
                $update = "UPDATE sobrenos SET 
                	banner        = '".$final_file."'
                WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
                
                echo '<div class="alert alert-success" role="alert">Banner: atualizado com sucesso.</div>';
                
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/banner'>";
            }
            
        }
    }
    
    function logo() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        $sql_logo = mysqli_query($conexao,"SELECT * FROM logo WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
        $resultado_logo = mysqli_fetch_assoc($sql_logo);
	
        if($resultado_logo['id'] <> ''){
            include('app/layout/'.$resultado_templete_i['templete'].'/user/logo/blocos/form.php');
        } else {
            $sql_loja="INSERT INTO logo (
                codigo_loja,
                id_loja
            ) VALUES(
                '".$codigo_loja."',
                '".$id_loja."'
            )";
            mysqli_query($conexao, $sql_loja);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/logo'>";
        }
    }
    
    function AtualizarLogo() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        include('app/db_configuracao/urlAmigavel.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        
        if(isset($_POST['BtnEditarLogo'])){
            $sql_logo = mysqli_query($conexao,"SELECT * FROM logo WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'") or die("Erro");
            $resultado_logo	= mysqli_fetch_assoc($sql_logo);
			
			array_map('unlink', glob($resultado_logo['file']));
			
            $file = md5(rand(1000,100000)."-".$_FILES['imagem']['name']);
            $file_loc   = $_FILES['imagem']['tmp_name'];
            $file_size    = $_FILES['imagem']['size'];
            $file_type    = $_FILES['imagem']['type'];
            $folder       ="uploads/"; 
            
            // new file size in KB
            $new_size = $file_size/1024;  
            // new file size in KB
          
            // make file name in lower case
            $new_file_name = strtolower($file);
            // make file name in lower case
          
            $final_file=str_replace(' ','-',$new_file_name);
            
            if(move_uploaded_file($file_loc,$folder.$final_file)){
                
                
                $update = "UPDATE logo SET 
                	file        = 'uploads/".$final_file."'
                WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
                mysqli_query($conexao, $update);
                
                echo '<div class="alert alert-success" role="alert">Logo: atualizado com sucesso.</div>';
                
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '3;URL=https://".$host."/user/logo'>";
            }
            
        }
    }
    
    
    function AtualizarSobre() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
	    
	    if(isset($_POST['BtnEditarSobre'])){
	        $facebook       = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['facebook']);
	        $instagram      = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['instagram']);
	        $whatsapp       = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['whatsapp']);                  
	        $nome_empresa   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['nome_empresa']);
	        $titulo_util    = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['titulo_util']);
	        $sobre   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['sobre']);
	        
	        $update = "UPDATE sobrenos SET
                link_facebook   = '".$facebook."',
                link_instagram  = '".$instagram."',
                whatsapp        = '".$whatsapp."',
                sobre           = '".$sobre."',
                nome_empresa    = '".$nome_empresa."',
                titulo_util     = '".$titulo_util."'
            WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."'";
            mysqli_query($conexao, $update);
            
            echo '<div class="alert alert-success" role="alert">Dados atualizado com sucesso.</div>';
                    
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '3;URL=https://".$host."/user/sobre'>";
	    }
    }
    function sobre() {
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        $sql_sobre = mysqli_query($conexao,"SELECT * FROM sobrenos WHERE codigo_loja = '".$codigo_loja."' and id_loja = '".$id_loja."'") or die("Erro");
	    $resultado_sobre = mysqli_fetch_assoc($sql_sobre);
	
        if($resultado_sobre['ID'] <> ''){
            include('app/layout/'.$resultado_templete_i['templete'].'/user/sobre/blocos/form.php');
        } else {
            $sql_loja="INSERT INTO sobrenos (
                codigo_loja,
                id_loja
            ) VALUES(
                '".$codigo_loja."',
                '".$id_loja."'
            )";
            mysqli_query($conexao, $sql_loja);
            
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/user/sobre'>";
        }
    }
}