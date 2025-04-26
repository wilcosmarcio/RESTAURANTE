<?php
session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

// Verifica se estamos no localhost ou em produção (Render)
$serverName = $_SERVER['SERVER_NAME'];

if ($serverName === 'localhost') {
    // Ambiente LOCAL (XAMPP)
    $servername = "localhost";
    $username   = "root";         // seu usuário local
    $password   = "";             // sua senha local (normalmente vazia no XAMPP)
    $db_name    = "nome_do_banco"; // ajuste para o seu banco no XAMPP

    $conexao = mysqli_connect($servername, $username, $password, $db_name);

    if (!$conexao) {
        die("Falha na conexão local: " . mysqli_connect_error());
    }

} else {
    // Ambiente PRODUÇÃO (Render)
    // Aqui no Render, como não tem banco local, você pode:
    // - deixar a variável $conexao como NULL
    // - ou configurar conexão a um banco externo se quiser

    $conexao = null;
    // Exemplo se quiser conectar a um banco externo (tipo PlanetScale, db4free etc):
    /*
    $servername = "nome-do-host-externo";
    $username   = "usuario_banco";
    $password   = "senha_banco";
    $db_name    = "nome_do_banco";

    $conexao = mysqli_connect($servername, $username, $password, $db_name);

    if (!$conexao) {
        die("Falha na conexão produção: " . mysqli_connect_error());
    }
    */
}
?>
