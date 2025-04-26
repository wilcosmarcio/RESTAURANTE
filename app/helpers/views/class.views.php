<?php
class views{
    function geral(){
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        include('app/db_configuracao/urlAmigavel.php');
        
        $sql_url = mysqli_query($conexao,"SELECT * FROM views_mes WHERE pagina = '".$baseUri."' and mes = '".date('m')."' and ano = '".date('Y')."' ORDER BY 'id'") or die("Erro");
	    $resultado_url = mysqli_fetch_assoc($sql_url);
	    
	    $data_validade_campanha = date('d F Y');
	    if($_COOKIE[view] == ''){
	        echo '<script>document.cookie = "view=1; expires=Thu; path=/";</script>';
	        
    	    $somaViews = $resultado_url['views'] + 1;
    	    if($resultado_url['id'] == ''){
    	        $sql="INSERT INTO views_mes (
                            mes, 
                            ano,
                            pagina,
                            views
                        ) VALUES(
                            '".date('m')."', 
                            '".date('Y')."',
                            '".$baseUri."',
                            '1'
                        )";
                mysqli_query($conexao, $sql);
    	    } else {
    	        $query = "UPDATE views_mes SET
                    views   	= '".$somaViews."'
                WHERE pagina = '".$baseUri."' and mes = '".date('m')."' and ano = '".date('Y')."'";
                mysqli_query($conexao, $query);
    	    }
	    }
    }
}