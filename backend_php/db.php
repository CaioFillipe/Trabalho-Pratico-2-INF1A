
<?php
$servername = "localhost";
$username = "root";  // Ajuste conforme sua configuração
$password = "";      // Ajuste conforme sua configuração
$dbname = "estante_de_livros";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
