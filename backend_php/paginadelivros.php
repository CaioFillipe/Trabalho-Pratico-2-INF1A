<?php
session_start();
if (!isset($_SESSION['usuario'])) { //VERIFICA SE A VARIÁVEL DE SESSÃO "USUÁRIO" ESTÁ DEFINIDA
    header("Location: sistemalogin.php"); //SE NÃO ESTÁ DEFINIDO, DIRIGE O USUÁRIO PARA A PÁGINA DE LOGIN
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/estilo.css">
</head>
<body>
    <div class="caixa-grande">
        <h1>Olá, <?php echo $_SESSION['usuario']['nome']; ?>! 👋</h1>
        <div class="livros">
            <div class="coluna">
                <h3>Lendo Agora 📖</h3>
                <!-- Livros aqui -->
            </div>
            <div class="coluna">
                <h3>Já Li ✅</h3>
                <!-- Livros aqui -->
            </div>
        </div>
        <a href="backend_php/saidaconta.php" class="botao-sair">Sair 🚪</a>
    </div>
</body>
</html>