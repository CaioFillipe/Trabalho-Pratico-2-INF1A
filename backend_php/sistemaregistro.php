<?php
include('backend_php/conexaobancodedados.php');

if ($_POST) {
    $nome = $_POST['nome']; //PEGA O NOME INFORMADO PELO USUÁRIO
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); //ARMAZENA A SENHA INFORMADA PELO USUÁRIO ATRAVÉS DE HASHING
    
    $sql = "INSERT INTO usuarios (nome, senha) VALUES ('$nome', '$senha')"; //INSERE O NOVO USUÁRIO NO BANCO DE DADOS
    
    if ($conexao->query($sql)) { //VERIFICA SE A INSERÇÃO OBTEVE SUCESSO, SE SIM, DIRECIONA O PARA A PÁGINA DE LOGIN
        header("Location: entrar.php?sucesso=1");
    } else { //SE NÃO, AVISA QUE DEU ERRO
        echo "<script>alert('Deu errado! Tente outro nome.');</script>";
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
        <h2>📚 Criar Conta</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="password" name="senha" placeholder="Senha secreta" required>
            <button type="submit">Vamos lá! 🚀</button>
        </form>
        <p>Já tem conta? <a href="sistemalogin.php">Entrar aqui</a></p>
    </div>
</body>
</html>
