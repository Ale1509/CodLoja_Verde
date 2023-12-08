<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lojaverde";
$port = 3306;
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>