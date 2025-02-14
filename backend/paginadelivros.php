<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../paginalogin.html");
    exit();
}

$usuario = $_SESSION['usuario']; // Dados do usuário logado
$usuario_id = $usuario['id'];

// Recuperar livros do usuário organizados por categoria
$sql = "SELECT * FROM livros WHERE usuario_id = ? ORDER BY FIELD(categoria, 'andamento', 'concluido', 'futuro')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$livros = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale=1.0">
    <title>Sua Página - Estante de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/paginaLivros.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pinyon+Script&display=swap" rel="stylesheet">

</head>
<body>
    <main>
        <header>
            <img src="https://media.istockphoto.com/id/1495088043/pt/vetorial/user-profile-icon-avatar-or-person-icon-profile-picture-portrait-symbol-default-portrait.jpg?s=612x612&w=0&k=20&c=S7d8ImMSfoLBMCaEJOffTVua003OAl2xUnzOsuKIwek=" alt="Foto do usuário">
            <h1>Bem-vindo, Caio!</h1>
        </header>
            

        <section>
            
            <div class="categoria" id="em-andamento">
                <h2>Leituras em Andamento</h2>
                <ul>
                            <li>
                                <img src="https://m.media-amazon.com/images/I/71u5XmMflAL._AC_UF1000,1000_QL80_.jpg" class="livro-foto">
                                <p>Querido diário otário</p>
                            </li>
                   
                </ul>
            </div>

            <div class="categoria" id="concluidos">
                <h2>Leituras Concluídas</h2>
                <ul>
                   
                            <li>
                                <img src="https://m.media-amazon.com/images/I/51KWGXOX9lL._AC_UF1000,1000_QL80_.jpg" class="livro-foto">
                                <p>Querido diário otário - preto</p>
                            </li>
             
                </ul>
            </div>

            <div class="categoria" id="futuro">
                <h2>Leituras Futuras</h2>
                <ul>
                    
                            <li>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOSa-Bym4ngVjEbJ6-Qw_V_5IYqGqWu3GUPg&s" class="livro-foto">
                                <p>Querido diário otário - GREENALDO</p>
                            </li>
       
                </ul>
            </div>

        </section>

        <button id="adicionar-livro" class="btn btn-success">Adicionar Novo Livro</button>
        <a href="saidaconta.php" class="btn btn-danger" id="link-saida">Sair</a>
    </main>

    <div id="modal" class="sumida container-fluid">
        <h2>Adicionar Novo Livro</h2>
        <form action="adicionarlivro.php" method="POST" enctype="multipart/form-data" id="form-modal">
            <input type="text" name="nome" placeholder="Nome do Livro" required>
            <input type="file" name="foto" accept="image/*" required>
            <select name="categoria" required>
                <option value="andamento">Em Andamento</option>
                <option value="concluido">Leitura Concluída</option>
                <option value="futuro">Leitura Futura</option>
            </select>
            <div id="botoes-div">
                <button id="fechar" class="btn btn-danger" >X</button>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="modal.js"></script>
</body>
</html>