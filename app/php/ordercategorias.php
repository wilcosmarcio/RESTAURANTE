<?php session_start();?>
<?php
include('app/db_configuracao/tabelas.php');

if($validacao == 'ok'){
    $array_aulas = $_POST['arrayordem'];

    $cont_ordem = 1;
    foreach($array_aulas as $id_aula){
    	$update = "UPDATE categoria_produtos SET
        	sequencia              = '".$cont_ordem."'
        WHERE id_loja = '".$id_loja."' and codigo_loja = '".$codigo_loja."' and id = '".$id_aula."'";
        mysqli_query($conexao, $update);
    	$cont_ordem++;
    }
    echo "<span style='color: green;'>Alterado com sucesso</span>";
}
?>