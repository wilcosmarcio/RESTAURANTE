<?php
if(isset($_POST['btn_atualizar'])){
//Dados usuario
$nome_completo  = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['nome']);
$cep            = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['cep']);
$rua            = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['rua']);
$numero         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['numero']);
$bairro         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['bairro']);
$cidade         = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['cidade']);
$uf             = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['uf']);
$telefone       = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['telefone']);

if($_POST['senha'] <> ''){
    $s = md5(base64_encode($_POST['senha']));
    $senha          = ", senha    = '$s'";
} else {
    $senha = '';
}
$query = "UPDATE usuario_agenda SET
    nome        = '".$nome_completo."',
    cep         = '".$cep."',
    rua         = '".$rua."',
    numero      = '".$numero."',
    bairro      = '".$bairro."',
    cidade      = '".$cidade."',
    uf          = '".$uf."',
    telefone    = '".$telefone."'
    ".$senha."
    WHERE id='$id_user'";
mysqli_query($conexao, $query);

echo "<script> window.history.go(-1); </script>";
}
?>