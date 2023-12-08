<?php
include '../dao/Conexao.php';

if (isset($_POST['buscar_dados'])) {
  // Obter os dados enviados pela requisição AJAX
  $dados = json_decode($_POST['dados'], true);
  $usuario = $dados[0]['usuario'];
  $senha = $dados[0]['senha'];
  // Consultar o banco de dados para verificar se o usuário existe
  $sql = "SELECT * FROM login WHERE usuario = '$usuario' AND senha = '$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // O usuário existe
    echo json_encode(true);
  } else {
    // O usuário não existe
    echo json_encode(false);
  }
}

if (isset($_POST['registrar_usuario'])) {
  // Obter os dados enviados pela requisição AJAX
  $dados = json_decode($_POST['dados'], true);
  $usuario = $dados['usuario'];
  $senha = $dados['senha'];

  // Inserir o novo usuário no banco de dados
  $sql = "INSERT INTO login (usuario, senha) VALUES ('$usuario', '$senha')";

  if ($conn->query($sql) === true) {
    // O usuário foi registrado com sucesso
    echo json_encode(true);
  } else {
    // Ocorreu um erro ao registrar o usuário
    echo json_encode(false);
  }
}

$conn->close();
?>
