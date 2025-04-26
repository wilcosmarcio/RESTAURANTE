<?php
    class ads{
        function views(){
            
        }
        function clique(){
            include('app/db_configuracao/dbconfig.php');
            include('app/db_configuracao/tabelas.php');
            include('app/db_configuracao/urlAmigavel.php');
            
            $sql_ads    = mysqli_query($conexao,"select * from tbl_uploads WHERE codigo = '".$url2."'") or die("Erro");
            $total_ads  = mysqli_num_rows($sql_ads);
            
            $resultado_dados = mysqli_fetch_assoc($sql_ads);
            
            $clique = $resultado_dados['cliques'] + 1;
            
            if($total_ads > 0){
                
                $query = "UPDATE tbl_uploads SET
                    cliques   	= '".$clique."'
                WHERE codigo = '".$url2."'";
                mysqli_query($conexao, $query);
                
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['link_botao']."'>";
            } else {
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."'>";
            }
        }
        
        function retangulo_topo(){
            include('app/db_configuracao/dbconfig.php');
            include('app/db_configuracao/tabelas.php');
            include('app/db_configuracao/urlAmigavel.php');
            
            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'retangulo-topo-m' ORDER BY RAND() LIMIT 1") or die("Erro");
            } else {
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'retangulo-topo' ORDER BY RAND() LIMIT 1") or die("Erro");
            }
            while($linhas_ads =mysqli_fetch_assoc($sql_ads)){
                $views = $linhas_ads['views'] + 1;
                
                $query = "UPDATE tbl_uploads SET
                    views   	= '".$views."'
                WHERE codigo = '".$linhas_ads['codigo']."'";
                mysqli_query($conexao, $query);
                
                if($linhas_ads['link_botao'] == ''){
                    echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                } else {
                    echo '<a href="https://'.$host.'/ads/clique/'.$linhas_ads['codigo'].'">';
                        echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                    echo '</a>';
                }
            }
            
        } //FIM RETANGULO TOPO
        
        function retangulo_rodape(){
            include('app/db_configuracao/dbconfig.php');
            include('app/db_configuracao/tabelas.php');
            include('app/db_configuracao/urlAmigavel.php');
            
            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'retangulo-rodape-m' ORDER BY RAND() LIMIT 1") or die("Erro");
            } else {
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'retangulo-rodape' ORDER BY RAND() LIMIT 1") or die("Erro");
            }
            while($linhas_ads =mysqli_fetch_assoc($sql_ads)){
                $views = $linhas_ads['views'] + 1;
                
                $query = "UPDATE tbl_uploads SET
                    views   	= '".$views."'
                WHERE codigo = '".$linhas_ads['codigo']."'";
                mysqli_query($conexao, $query);
                
                if($linhas_ads['link_botao'] == ''){
                    echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                } else {
                    echo '<a href="https://'.$host.'/ads/clique/'.$linhas_ads['codigo'].'">';
                        echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                    echo '</a>';
                }
            }
            
        } //FIM RETANGULO RODAPE
         
        function interna_esquerda(){
            include('app/db_configuracao/dbconfig.php');
            include('app/db_configuracao/tabelas.php');
            include('app/db_configuracao/urlAmigavel.php');
            
            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'Interna-esquerda-m' ORDER BY RAND() LIMIT 1") or die("Erro");
            } else {
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'Interna-esquerda' ORDER BY RAND() LIMIT 1") or die("Erro");
            }
            while($linhas_ads =mysqli_fetch_assoc($sql_ads)){
                $views = $linhas_ads['views'] + 1;
                
                $query = "UPDATE tbl_uploads SET
                    views   	= '".$views."'
                WHERE codigo = '".$linhas_ads['codigo']."'";
                mysqli_query($conexao, $query);
                
                if($linhas_ads['link_botao'] == ''){
                    echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                } else {
                    echo '<a href="https://'.$host.'/ads/clique/'.$linhas_ads['codigo'].'">';
                        echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                    echo '</a>';
                }
            }
            
        } //FIM RETANGULO RODAPE
        
        function interna_direita(){
            include('app/db_configuracao/dbconfig.php');
            include('app/db_configuracao/tabelas.php');
            include('app/db_configuracao/urlAmigavel.php');
            
            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) { 
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'Interna-direita-m' ORDER BY RAND() LIMIT 1") or die("Erro");
            } else {
                $sql_ads = mysqli_query($conexao,"select * from tbl_uploads WHERE local = 'Interna-direita' ORDER BY RAND() LIMIT 1") or die("Erro");
            }
            while($linhas_ads =mysqli_fetch_assoc($sql_ads)){
                $views = $linhas_ads['views'] + 1;
                
                $query = "UPDATE tbl_uploads SET
                    views   	= '".$views."'
                WHERE codigo = '".$linhas_ads['codigo']."'";
                mysqli_query($conexao, $query);
                
                if($linhas_ads['link_botao'] == ''){
                    echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                } else {
                    echo '<a href="https://'.$host.'/ads/clique/'.$linhas_ads['codigo'].'">';
                        echo '<img src="https://'.$host.'/uploads/'.$linhas_ads['file'].'" style="width: 100%;">';
                    echo '</a>';
                }
            }
            
        } //FIM RETANGULO RODAPE
        
    }
?>