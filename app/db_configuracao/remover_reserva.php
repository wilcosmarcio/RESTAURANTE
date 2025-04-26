<?php
//Remover agendamento que nao foi pago até o prazo
	$delete = "DELETE FROM events WHERE id_empresa = '".$resultado_dados['id']."' and status = '1' and cod_data_prazo_pix < '".strtotime(date('Y-m-d H:i:s'))."'";
    mysqli_query($conexao, $delete);
?>