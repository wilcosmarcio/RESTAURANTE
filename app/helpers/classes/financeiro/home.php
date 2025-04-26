<?php
class financeiro{
    function total_hoje(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
            COALESCE(SUM(ci.total_concluido), 0.00) AS total
            FROM 
            ComandaPedidos AS cp 
            LEFT JOIN ComandaId ci ON ci.comanda = cp.comanda
            WHERE cp.data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."';
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            $total = number_format($row["total"], 2, ',', '.');
            echo $total;
        }
    }
    function total_mes(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
            COALESCE(SUM(ci.total_concluido), 0.00) AS total
            FROM 
            ComandaPedidos AS cp 
            LEFT JOIN ComandaId ci ON ci.comanda = cp.comanda
            WHERE cp.data BETWEEN '".date('Y-m-')."01' AND '".date('Y-m-d')."' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."';
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            $total = number_format($row["total"], 2, ',', '.');
            echo $total;
        }
    }
    function qtde_aberta(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
        COUNT(*) AS total
            FROM (
                SELECT comanda
                FROM ComandaPedidos
                WHERE data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND status = '1' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."'
                GROUP BY comanda
            ) AS subconsulta;
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            echo $row["total"];
        }
    }
    function qtde_preparando(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
        COUNT(*) AS total
            FROM (
                SELECT comanda
                FROM ComandaPedidos
                WHERE data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND status = '2' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."'
                GROUP BY comanda
            ) AS subconsulta;
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            echo $row["total"];
        }
    }
    function qtde_entregando(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
        COUNT(*) AS total
            FROM (
                SELECT comanda
                FROM ComandaPedidos
                WHERE data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND status = '3' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."'
                GROUP BY comanda
            ) AS subconsulta;
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            echo $row["total"];
        }
    }
    function qtde_finalizado(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
        COUNT(*) AS total
            FROM (
                SELECT comanda
                FROM ComandaPedidos
                WHERE data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND status = '4' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."'
                GROUP BY comanda
            ) AS subconsulta;
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            echo $row["total"];
        }
    }
    function qtde_cancelado(){
        $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $url = (isset($_GET['url'])) ? $_GET['url']:'index';
        $url = array_filter(explode('/',$url));
        
        include('app/db_configuracao/dbconfig.php');
        include('app/db_configuracao/tabelas.php');
        
        $sql_comandas = mysqli_query($conexao,"SELECT 
        COUNT(*) AS total
            FROM (
                SELECT comanda
                FROM ComandaPedidos
                WHERE data BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."' AND status = '5' AND codigo_loja = '".$codigo_loja."' AND id_loja = '".$id_loja."'
                GROUP BY comanda
            ) AS subconsulta;
        ") or die("Erro");
        if (mysqli_num_rows($sql_comandas) > 0) {
            $row = mysqli_fetch_assoc($sql_comandas);
            echo $row["total"];
        }
    }
}
