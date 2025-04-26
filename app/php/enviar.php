<?php

	if($url[0] == "enviar"){
			if($url[1] == ""){
				require_once 'painel/index/upload_orcamento.php';
			} 
			
			if($url[1] == "email"){
				require_once 'painel/index/upload_email.php';
			}
			
			if($url[1] == "whatsapp"){
				$nome 		= $_POST['nome'];
				$produto	= $_POST['servico'];
				$baseUri	= $_POST['baseUri'];
				
				echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://api.whatsapp.com/send?phone=550".$resultado_sobre['whatsapp']."&text=Olá meu nome é *".$nome."*, gostaria de solicitar um orçamento do produto: *".$produto."*. Url do produto: ".$baseUri."'>";
			}
			
			if($url[1] == "produto"){
				require_once 'painel/index/upload_orcamento_produto.php';
			} 
			
			if($url[1] == "servico"){
				require_once 'painel/index/upload_orcamento_servico.php';
			}
			
			if($url[1] == "depoimento"){
				require_once 'painel/index/upload_depoimento_cliente.php';
			}
			
		}

