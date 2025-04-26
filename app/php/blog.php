<?php
//VIEWS
include('app/helpers/views/class.views.php');
$object_views = new views;
$object_views->geral();
?>
<?php
include('app/helpers/ads/class.ads.php');
$object_ads = new ads;

		if($url[0] == "blog"){
		    
		    if($url[2] == "categoria"){
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/blog/index.php';
			}
		    
			if($url[1] == "conteudo"){
				
				$sql_blog = mysqli_query($conexao,"SELECT * FROM blog  WHERE url = '".$url[2]."'") or die("Erro");
				$resultado_blog = mysqli_fetch_assoc($sql_blog);
				
				$sql_recomendados_direita =   mysqli_query($conexao,"SELECT * FROM blog  WHERE url <> '".$url[2]."' ORDER BY RAND() LIMIT 5") or die("Erro");
				
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/blog/conteudo/index.php';
			} else {
				require_once 'app/layout/'.$resultado_templete_i['templete'].'/blog/index.php';
			}
		}
	
	
	
	
?>