<?php
session_start();
include('conexaobancodedados.php');

if ($_POST) { //VERIFICA SE O FORMULÁRIO FOI ENVIADO COM O METODO POST
    $nome = $_POST['nome']; //PEGA O NOME DO USUÁRIO DIGITADO
    $senha = $_POST['senha']; //PEGA A SENHA INFORMADA
    $sql = "SELECT * FROM usuarios WHERE nome = '$nome'"; //CONSULTA AO BANCO DE DADOS
    $resultado = $conexao->query($sql);
    
    if ($resultado->num_rows > 0) { //VERIFICA SE EXISTE ESTE USUÁRIO NO BANCO DE DADOS
        $usuario = $resultado->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) { //VERIFICA SE A SENHA CORRESPONDE A SENHA INFORMADA NO BANCO DE DADOS
            $_SESSION['usuario'] = $usuario; //ATUALIZA A SESSÃO ATUAL
            header("Location: paginadelivros.php"); //DIRECIONA O USUÁRIO PARA SUA PÁGINA DE LIVROS
        } else {
            echo "<script>alert('Ih, tá dando calote é? Senha errada! ');</script>";
        }
    } else {
        echo "<script>alert('Mana, para de ser louca! Este usuário não existe! ');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paginaRegistro.css">
    <title>Login - Estante de Livros</title>
    <link rel="icon" href="6c2589cd04394c6bac9f4bff26e58045.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/paginaPrincipal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pinyon+Script&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <header>
            <h1>FLOPESTANTE</h1>
            <img src="6c2589cd04394c6bac9f4bff26e58045.png">
            <p>Bem vindo a flopestante, a sua web estante favorita de livros!</p>
        </header>
        <section>
            <div id="quadro-login" class="container-fluid">
                <h2>Entrar</h2>
                <form method="post">
                    <input type="text" class="form-control" name="nome" placeholder="Seu nome" required>
                    <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    <button type="submit" class="btn btn-warning">Entrar</button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>

