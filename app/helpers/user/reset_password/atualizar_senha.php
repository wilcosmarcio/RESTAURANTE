<?php
    $encriptPass = password_hash($senha_user, PASSWORD_BCRYPT, ['cost' => 12]);
    $query = "UPDATE usuario_agenda SET
        reset_password  = '',
        senha           = '".$encriptPass."'
        WHERE id='$id_user'";
    mysqli_query($conexao, $query);
    
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=".$resultado_dados['certificado']."://".$host."/user'>";
?>







