<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../dashboard.html");
        } else {
            echo "<script>alert('Nome ou senha incorretos!'); window.location.href='../index.html';</script>";
        }
    } else {
        echo "<script>alert('Nome ou senha incorretos!'); window.location.href='../index.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>