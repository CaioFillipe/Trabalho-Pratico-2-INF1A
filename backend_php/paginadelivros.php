<?php
session_start();
include('db.php');

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Estante de Livros</title>
    <link rel="stylesheet" href="css/estilopaginadelivros.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo, <?php echo $usuario['nome']; ?>!</h1>
        <img src="assets/img/<?php echo $usuario['foto']; ?>" alt="Foto do usuário" class="foto-usuario">

        <div class="livros-categorias">
            <div class="categoria" id="em-andamento">
                <h2>Leituras em Andamento</h2>
                <ul>
                    <?php foreach ($livros as $livro): ?>
                        <?php if ($livro['categoria'] == 'andamento'): ?>
                            <li>
                                <img src="img_livros/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['nome']; ?>" class="livro-foto">
                                <p><?php echo $livro['nome']; ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="categoria" id="concluidos">
                <h2>Leituras Concluídas</h2>
                <ul>
                    <?php foreach ($livros as $livro): ?>
                        <?php if ($livro['categoria'] == 'concluido'): ?>
                            <li>
                                <img src="img_livros/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['nome']; ?>" class="livro-foto">
                                <p><?php echo $livro['nome']; ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="categoria" id="futuro">
                <h2>Leituras Futuras</h2>
                <ul>
                    <?php foreach ($livros as $livro): ?>
                        <?php if ($livro['categoria'] == 'futuro'): ?>
                            <li>
                                <img src="img_livros/<?php echo $livro['foto']; ?>" alt="<?php echo $livro['nome']; ?>" class="livro-foto">
                                <p><?php echo $livro['nome']; ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <button id="adicionar-livro">Adicionar Novo Livro</button>
        <a href="saidaconta.php" class="logout-button">Sair</a>
    </div>

    <!-- Modal para adicionar livro -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close">X</span>
            <h2>Adicionar Novo Livro</h2>
            <form action="adicionarlivro.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="Nome do Livro" required>
                <input type="file" name="foto" accept="image/*" required>
                <select name="categoria" required>
                    <option value="andamento">Em Andamento</option>
                    <option value="concluido">Leitura Concluída</option>
                    <option value="futuro">Leitura Futura</option>
                </select>
                <button type="submit">Adicionar</button>
            </form>
        </div>
    </div>
    <script src="js/modal.js"></script>
</body>
</html>