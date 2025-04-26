<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
session_start();
?>
<?php
if($url[1] == "verificar"){
	include('app/painel/verificar/verificar.php');
} else {
		if(isset($_SESSION['usuario_id'])){
			
			
			if($url[1] == ""){
				include('app/painel/index.php');
			}
		
		
		if($url[1] == "blog"){
			if($url[2] == ""){
				include('app/painel/blog/listagem.php');
			}
			
			if($url[2] == "cadastrar"){
				include('app/painel/blog/cadastrar.php');
			}
			
			if($url[2] == "editar"){
				include('app/painel/blog/editar.php');
			}
			
			if($url[2] == "excluir"){
				include('app/painel/blog/excluir.php');
			}
		}
		
		if($url[1] == "produto"){
			if($url[2] == ""){
				include('app/painel/produto/listagem.php');
			}
			
			if($url[2] == "cadastrar"){
				include('app/painel/produto/cadastrar.php');
			}
			
			if($url[2] == "editar"){
				include('app/painel/produto/editar.php');
			}
			
			if($url[2] == "excluir"){
				include('app/painel/produto/excluir.php');
			}
		}
		
		if($url[1] == "servico"){
			if($url[2] == ""){
				include('app/painel/servico/listagem.php');
			}
			
			if($url[2] == "cadastrar"){
				include('app/painel/servico/cadastrar.php');
			}
			
			if($url[2] == "editar"){
				include('app/painel/servico/editar.php');
			}
			
			if($url[2] == "excluir"){
				include('app/painel/servico/excluir.php');
			}
		}
		
		if($url[1] == "usuarios"){
			if($url[2] == ""){
				include('app/painel/usuarios/listagem.php');
			}
			
			if($url[2] == "cadastrar"){
				include('app/painel/usuarios/cadastrar.php');
			}
			
			if($url[2] == "editar"){
				include('app/painel/usuarios/editar.php');
			}
			
			if($url[2] == "excluir"){
				include('app/painel/usuarios/excluir.php');
			}
		}
		
		if($url[1] == "banner"){
			if($url[2] == ""){
				include('app/painel/banner/listagem.php');
			}
			
			if($url[2] == "cadastrar"){
				include('app/painel/banner/cadastrar.php');
			}
			
			if($url[2] == "editar"){
				include('app/painel/banner/editar.php');
			}
			
			if($url[2] == "excluir"){
				include('app/painel/banner/excluir.php');
			}
		}
		
		if($url[1] == "logout"){
			include('app/painel/logout/index.php');
		}
		
		
		if($url[1] == "login"){
			echo "<script>
				        window.location.href='http://".$host."/".$resultado_painel['painel']."/';
				        </script>";
		}
		
		
		
		
		} else {
			if($url[0] == $resultado_painel['painel']){
				if($url[1] == "login"){
					echo  "";
				} else {
					echo "<script>
				        window.location.href='http://".$host."/check/';
				        </script>";
				}
			}
			if($url[1] == "login"){
				include('app/painel/login.php');
			}
		}
	}
	
	
	 
	
	