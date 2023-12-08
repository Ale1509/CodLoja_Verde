<?php
include '../../dao/Conexao.php';
$dados = isset($_POST['dados']) ? json_decode($_POST['dados'], true) : null;
if ($dados) {
    foreach ($dados as $item) {
        $nome = $conn->real_escape_string($item['nome']);
        $telefone = $conn->real_escape_string($item['telefone']);
        $email = $conn->real_escape_string($item['email']);
        $genero = $conn->real_escape_string($item['genero']);
        $maior = $conn->real_escape_string($item['maior']);

        // Verificar se o e-mail é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "O endereço de e-mail inserido não é válido.";
            continue; // Pula para a próxima iteração do loop sem inserir o usuário
        }
        if (isset($item['id'])) {
            $id = $conn->real_escape_string($item['id']);
            // Verificar se o usuário já existe pelo ID
            $sql = "SELECT * FROM usuarios WHERE id='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "Usuário já existe";
                // Atualizar os dados do usuário existente
                $sql = "UPDATE usuarios SET nome='$nome', telefone='$telefone', email='$email', genero='$genero', maior = '$maior' WHERE id='$id'";
                if ($conn->query($sql) === true) {
                    echo "Dados atualizados:";
                    echo json_encode($dados);
                } else {
                    echo "Erro ao atualizar os dados no banco de dados: " . $conn->error;
                }
                continue; // Pula para a próxima iteração do loop sem inserir o usuário
            }
        }
        
        // Inserir o usuário na tabela de usuários
        $sql = "INSERT INTO usuarios (nome, telefone, email, genero, maior) VALUES ('$nome', '$telefone', '$email', '$genero' , '$maior')";
        if ($conn->query($sql) === true) {
            echo "Dados salvos:";
            echo json_encode($dados);
        } else {
            echo "Erro ao salvar os dados no banco de dados: " . $conn->error;
        }
    }
}


else if (isset($_POST['buscar_dados'])) {
    // Buscar os dados na tabela de usuários
    $sql = "SELECT * FROM usuarios"; //consulta sql
    $result = $conn->query($sql); // Executa a consulta SQL armazenada na variável $sql e armazena o resultado na variável $result
    if ($result->num_rows > 0) {
        // gerando a tabela HTML
        $html = '<table class="minha-tabela">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Telefone</th>';
        $html .= '<th>E-mail</th>';
        $html .= '<th>Gênero</th>';
        $html .= '<th>ID</th>';
        $html .= '<th>Maior</th>';
        $html .= '<th>Ação</th>'; 
        $html .= '<th>Ação</th>'; 
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . $row["nome"] . '</td>';
            $html .= '<td>' . $row["telefone"] . '</td>';
            $html .= '<td>' . $row["email"] . '</td>';
            $html .= '<td>' . $row["genero"] . '</td>';
            $html .= '<td>' . $row["id"] . '</td>';
            $html .= '<td>' . ($row["maior"] == 1 ? "Sim" : "Não") . '</td>'; // Substitui 1 por "Sim" e 0 por "Não". Basicamente um if
            $html .= '<td><button class="btn" id= "btneditar" onclick="editar(' . $row["id"] . ')">Editar</button></td>'; // Botão de editar recebe o ID do usuário como parâmetro
            $html .= '<td><button class="btn" id = "btnexcluir" onclick="excluir(' . $row["id"] . ')">Excluir</button></td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    } else {
        echo "Nenhum dado encontrado na tabela.";
    }
} 

else if (isset($_POST['excluir_tudo'])) {
    // Excluir todos os dados da tabela de usuários
    $sql = "DELETE FROM usuarios";
    if ($conn->query($sql) === true) {
        $sql = "ALTER TABLE usuarios AUTO_INCREMENT = 1";
        $conn->query($sql);
        echo "Todos os dados foram excluídos com sucesso.";
    } else {
        echo "Erro ao excluir os dados do banco de dados: " . $conn->error;
    }
}

else if (isset($_POST['excluir_usuario'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE ID = $id";
    if ($conn->query($sql) === true) {
        echo "Todos os dados foram excluídos com sucesso.";
    } else {
        echo "Erro ao excluir os dados do banco de dados: " . $conn->error;
    }
}
else if (isset($_GET['editar_usuario']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE ID = $id"; //pega os dados do usuário pelo id.
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { // Isso indica se algum dado foi encontrado para o ID fornecido
        $row = $result->fetch_assoc(); //retorna os dados em cada campo de texto, lá no javascript.
        $nome = $conn->real_escape_string($row['nome']);
        $telefone = $conn->real_escape_string($row['telefone']);
        $email = $conn->real_escape_string($row['email']);
        $genero = $conn->real_escape_string($row['genero']);
        $maior = $conn->real_escape_string($row['maior']);
        echo $row['nome'] . ',' . ($row['telefone']) . ',' . ($row['email']) . ',' . $id . ',' . $genero . ',' . $maior; // Adicionar o ID e o gênero ao final da resposta
    } else {
        echo "Nenhum dado encontrado para o ID fornecido.";
    }
}
$conn->close();
?>