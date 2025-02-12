<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Insere o novo usuário o banco de dados
    $sql = "INSERT INTO usuarios (nome, senha) VALUES ('$nome', '$senha')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>