<?php
//PÁGINA DE CONEXÃO COM O BANCO DE DADOS  
$nomeServidor = "localhost";
$usuario = "root";
$senha = "";
$bancoDeDados = "estante_livros";

$conexao = new mysqli($nomeServidor, $usuario, $senha, $bancoDeDados);

if ($conexao->connect_error) {
    die("Erro na conexão");
}
?>