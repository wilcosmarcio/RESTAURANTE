<?php
    $to         = $email;
    $subject    = "Cadastro - ".$nomeEmpresa;
    
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
      <h2>Ol&aacute; '.$nome_empresa.'!</h2>
      <br>
      <b>É com prazer que confirmamos seu cadastro em nossa plataforma! 
      <br><br>
      Esperamos que você aproveite ao máximo nossos serviços.
        <br>
        Como forma de ajudá-lo a explorar seu cadastro, gostaríamos de compartilhar o ID da sua loja, que é '.$codigo_loja.', guarde ele pois será usado para acessar o painel administrativo. 
        <br>
        Além disso, para facilitar seu acesso ao cardápio, aqui está a URL: https://'.$dominio_app.'/loja/'.$codigo_loja.'.
        <br>
        Se você tiver alguma dúvida ou precisar de ajuda para navegar, não hesite em entrar em contato conosco. Estamos aqui para ajudá-lo(a)!

        Atenciosamente,
        '.$nomeEmpresa.'.</b>
      <br><br>
     </div>
    
    </body>
    </html>
    ';
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <'.$EmailEmpresa.'>' . "\r\n";
    mail($to,$subject,$message,$headers);
?>