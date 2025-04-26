<?php
	//Pagamento Aprovado
	if($_POST['transaction']['status_id'] == "6"){
		$query = "UPDATE pedidos SET status = '2' WHERE id = '".$_POST['transaction']['order_number']."'";
        mysqli_query($conexao, $query);
	}
?>





























