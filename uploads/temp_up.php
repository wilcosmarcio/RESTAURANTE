<form action="" method="post" enctype="multipart/form-data">
<!--nesse input damos o nome MAX_FILE_SIZE e o Máximo de bits que ele pode ter do tipo hidden(oculto)-->
<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
<!--nesse input damos o nome "arquivo" e o tipo de "file"-->
Arquivo: <input type="file" name="arquivo" /><br />
<input type="submit" name="enviar" /><br />
</form>

<?php

 /*se clicarmos em Enviar Dados iniciaremos a leitura desse bloco*/
 if(isset($_POST['enviar'])){
    /* dê um var_dump($_FILES) ou print_r($_FILES) pra entender melhor essa parte, são os valores do array, nome, tipo, tamanho, erro, nome temporario...*/
    $nome = $_FILES['arquivo']['name'];
    $tmp  = $_FILES['arquivo']['tmp_name'];
    $erro = $_FILES['arquivo']['error'];
    /* o caminho mais o nome do aquivo para que possamos salvar o arquivo em determinada pasta */
    $arquivocam = $caminho . $nome;

    /* se a chave erro for igual a 0, entraremos nesse bloco */
    if($erro == 0){
        /* usamos a função move_upload_file para mover, se der certo, completaremos o processo */
       if(move_uploaded_file($tmp, $arquivocam)){
          echo "Foi carregado com sucesso o arquivo: $nome";
          chmod($arquivocam,0777);
       }
    }
 }
?>