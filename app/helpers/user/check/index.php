<?php include('../../../../app/db_configuracao/dbconfig.php');?>
<?php 
    $search = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
    
    if($_GET['object'] == 'cnpj'){
        $sql_user_agenda = mysqli_query($conexao,"SELECT * FROM clientes WHERE cnpj_empresa = '".$search."' ORDER BY 'id'") or die("Erro");
        $resultado_user_agenda = mysqli_fetch_assoc($sql_user_agenda);
        
    	if($resultado_user_agenda['id'] <> ''){
    	    echo '<b style="color: red;">CNPJ já cadastrado!</b>';
    	}
    }
    
    if($_GET['object'] == 'email'){
        $sql_user_agenda = mysqli_query($conexao,"SELECT * FROM usuario_agenda WHERE email = '".$search."' ORDER BY 'id'") or die("Erro");
        $resultado_user_agenda = mysqli_fetch_assoc($sql_user_agenda);
        
        if($resultado_user_agenda['id'] <> ''){
    	    echo '<b style="color: red;">E-mail já cadastrado!</b>';
    	}
    }
?>










