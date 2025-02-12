<?php
session_start();
include('backend_php/conexaobancodedados.php');

if ($_POST) { //RECEBE A REQUISIÇÃO DO SISTEMA
    $nome = $_POST['nome']; //PEGA O NOME DO USUÁRIO DIGITADO
    $senha = $_POST['senha']; //PEGA A SENHA INFORMADA
    
    $sql = "SELECT * FROM usuarios WHERE nome = '$nome'"; //ENCONTRA UM DADO NO BANCO COM O MESMO NOME DE USUÁRIO
    $resultado = $conexao->query($sql);
    
    if ($resultado->num_rows > 0) { //VERIFICA SE EXISTE ESTE USUÁRIO NO BANCO DE DADOS
        if (password_verify($senha, $usuario['senha'])) { //VERIFICA SE A SENHA CORRESPONDE A SENHA INFORMADA NO BANCO DE DADOS
            $_SESSION['usuario'] = $usuario; //ATUALIZA A SESSÃO ATUAL
            header("Location: paginadelivros.php"); //DIRECIONA O USUÁRIO PARA SUA PÁGINA DE LIVROS
        } else {
            echo "<script>alert('Senha errada! 😅');</script>";
        }
    } else {
        echo "<script>alert('Usuário não existe! ❌');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/estilo.css">
</head>
<body>
    <div class="caixa">
        <h2>🔑 Entrar</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p>Não acreditoo! Você ainda não possui uma conta? <a href="sistemaregistro.php">Crie uma conta clicando aqui!</a></p>
    </div>
</body>
</html>
