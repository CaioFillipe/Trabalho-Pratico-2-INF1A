<?php
session_start();
include('db.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $foto = $_FILES['foto']['name'];
    $usuario_id = $_SESSION['usuario']['id']; // Pegar o ID do usuário logado

    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    // Fazer upload da foto
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO livros (nome, foto, categoria, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $foto, $categoria, $usuario_id);
        $stmt->execute();

        // Redirecionar para a dashboard após adicionar o livro
        header("Location: ../dashboard.php");
    } else {
        echo "<script>alert('Erro ao realizar o upload da foto selecionada.'); window.location.href='../dashboard.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
