<?php session_start(); ?>
<?php include('app/helpers/agendamento/class.listagem_agendamento.php');?>
<?php $ob_agenda = new listagem_agendamento;?>


<?php
	if($total_pay >= 1){
		require_once 'app/layout/bloqueado/index.php';
	} else {
		if($url[0] == "servicos"){
		    $sql_servicos = mysqli_query($conexao,"SELECT * FROM servicos WHERE id_empresa = '".$resultado_dados['id']."' and url = '".$url[2]."' and status = '1' ") or die("Erro");
            $resultado_servicos = mysqli_fetch_assoc($sql_servicos);
            
			if($resultado_servicos['id'] <> ''){
				if($url[1] == "agendar"){
                    
                    if(isset($_POST['btndata'])){
                        echo "<script> window.location.href='".$resultado_dados['certificado']."://".$host."/servicos/agendar/".$resultado_servicos['url']."/&data=".$_POST['data']."'; </script>";
                    }
                    
					require_once 'app/layout/'.$resultado_templete_i['templete'].'/servicos/agendar/index.php';
				} else {
					require_once 'app/layout/'.$resultado_templete_i['templete'].'/servicos/index.php';
				}
			} else {
			    echo "<script> window.location.href='".$resultado_dados['certificado']."://".$host."/'; </script>";
			}
		}
	}
	
	
	
?>