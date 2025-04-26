<?php

//GERADOR DE TOKEN RANDOMICO
$upper = implode('', range('A', 'Z')); // ABCDEFGHIJKLMNOPQRSTUVWXYZ
$lower = implode('', range('a', 'z')); // abcdefghijklmnopqrstuvwxyzy
$nums = implode('', range(0, 9)); // 0123456789

$alphaNumeric = $upper.$lower.$nums; // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789
$rand_token = '';
$len = 12; // numero de chars
for($i = 0; $i < $len; $i++) {
    $rand_token .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
}
$rand_num       = rand(1,999).''.$id_user;
$token_reset    = md5(base64_encode($rand_token)).'-'.md5(base64_encode($rand_num)).'-'.md5(base64_encode(date('d-m-Y H:i:s')));


//Atualiza o Token para reset
    $query = "UPDATE usuario_agenda SET
        reset_password  = '".$token_reset."'
        WHERE id='$id_user'";
    mysqli_query($conexao, $query);


    // ENVIO DE EMAIL COM LINK DE RESET
    
    $to         = $resultado_sobre['email'];
    $subject    = "Redefinir senha - ".$resultado_sobre['nome_empresa'];
    
    $message    .= '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="Content-type:text/html;charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    
    <div class="container">
      <h2>Ol&aacute; '.$nome_user.'!</h2>
      <b>Clique no link a baixo para trocar sua senha.</b>
      <br><br>
      <a href="'.$resultado_dados['certificado'].'://'.$host.'/user/reset_password/'.$token_reset.'" class="btn btn-primary" style="width: 100%; cursor: pointer;">Gerar nova senha <i class="fa fa-key"</a>      
    </div>
    
    </body>
    </html>
    ';
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <'.$email_sql.'>' . "\r\n";
    mail($to,$subject,$message,$headers);
  


?>





