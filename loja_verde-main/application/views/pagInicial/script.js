//variaveis globais que serão reutilizadas em varias funções.
let formularios = document.querySelector("#formularios");
let dadosSalvos = [];
let generoM = document.querySelector("#masc");
let generoF = document.querySelector("#fem");
let maiorIdade = document.querySelector('#maior')
function limpar() {
    dadosSalvos = [];
    limparTabela(); // Limpa o conteúdo da tabela
}

function salvar() {
    let nome = formularios.form1.value;
    let telefone = formularios.form2.value;
    let email = formularios.form3.value;
    let genero = "";
    let id = formularios.form4.value;
    let maior = 0;
  
    if (generoM.checked) {
      genero = "Masculino";
    } else if (generoF.checked) {
      genero = "Feminino";
    }
  
    if (maiorIdade.checked){
      maior = 1;
    }
  
    if (nome === "" || telefone === "" || email === "" || genero === "") {
      console.log("Preencha todos os campos antes de salvar.");
      alert("Preencha todos os campos antes de salvar.");
      return;
    }
  
    // Verificar se o e-mail é válido
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailRegex)) {
      console.log("O endereço de e-mail inserido não é válido.");
      alert("O endereço de e-mail inserido não é válido.");
      return;
    }
  
    // Verificar se o telefone é válido
    if (telefone.length < 14) {
      console.log("O telefone inserido é inválido.");
      alert("O telefone inserido é inválido.");
      return;
    }
  
    let dados = {
      nome: nome,
      telefone: telefone,
      email: email,
      genero: genero,
      id: id,
      maior: maior
    };
  
    dadosSalvos.push(dados);
    console.log(dados);
  
    limparCampos(); // Limpa os campos de entrada de dados
    alert("Dados salvos com sucesso !");
  
    $.ajax({
      url: 'controller.php',
      method: 'POST',
      data: { dados: JSON.stringify(dadosSalvos) },
      success: function(response) {
        console.clear();
        console.log('Dados salvos:', response);
        buscarDados();
        limparDadosSalvos();
      },
      error: function(error) {
        console.log('Erro ao salvar os dados.');
      }
    });
  }

function limparCampos() {
    formularios.form1.value = '';
    formularios.form2.value = '';
    formularios.form3.value = '';
    generoM.checked = false;
    generoF.checked = false;
    maiorIdade.checked = false;
}

function excluirTudo() {
    $.ajax({
        url: 'controller.php',
        method: 'POST',
        data: { excluir_tudo: true },
        success: function(response) {
            console.clear();
            console.log(response);
            limparDadosSalvos(); // Limpa os dados salvos no JavaScript
            buscarDados();
        },
        error: function(error) {
            console.log('Erro ao excluir os dados.');
        }
    });
}

function limparDadosSalvos() {
    dadosSalvos = []; // Limpa o array de dados salvos no JavaScript
}

$('.form2').mask('(00) 00000-0000');
function buscarDados() {
    let tabela = document.getElementById("minha-tabela");
    limparTabela(); // Limpa o conteúdo anterior da tabela
    limparDadosSalvos();
    $.ajax({
        url: 'controller.php',
        method: 'POST',
        data: { buscar_dados: true }, // Enviar uma flag para indicar a busca de dados
        success: function(response) {
            // Manipular a resposta da requisição aqui
            tabela.innerHTML = response;
        },
        error: function(error) {
            // Lidar com erros aqui
            console.log('Erro ao buscar os dados.');
           
        }
    });
}

function limparTabela() {
    let tabela = document.getElementById("minha-tabela");
    while (tabela.firstChild) {
        tabela.removeChild(tabela.firstChild);
    }
}
function editar(id) {
    console.clear();
    console.log("ID do usuário a ser editado: " + id);
    $.ajax({
        url: 'controller.php',
        method: 'GET',
        data: { editar_usuario: true, id: id },
        success: function(response) {
            console.clear();
            console.log(response);
            // Separar os valores da resposta usando a vírgula como delimitador
            var dadosUsuario = response.split(',');
            // Atribuir os valores dos dados do usuário aos campos de texto
            formularios.form1.value = dadosUsuario[0];
            formularios.form2.value = dadosUsuario[1];
            formularios.form3.value = dadosUsuario[2];
            formularios.form4.value = id; // Exibir o ID do banco de dados no campo form4
            let genero = dadosUsuario[4]; // Atribuir o valor do gênero recuperado dos dados do usuário (4 pq é o quarto item no array de dados, 3 eh o id)
            let maior = dadosUsuario[5];
            if (genero === "Masculino") {
                generoM.checked = true; // Definir o botão de rádio masculino como selecionado
            } else if (genero === "Feminino") {
                generoF.checked = true; // Definir o botão de rádio feminino como selecionado
            }
            if (maior == 1){
                maiorIdade.checked = true;
            }
            else if (maior == 0){
                maiorIdade.checked = false;
            }
        },
        error: function(error) {
            console.log('Erro ao buscar os dados do usuário.');
        }
    });
}
function excluir(id) {
    // Exibe a mensagem de confirmação ao usuário
    if (confirm("Tem certeza que deseja excluir o usuário?")) {
        console.log("ID do usuário a ser excluído: " + id);
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            data: { excluir_usuario: true, id: id },
            success: function(response) {
                console.clear();
                console.log(response);
                limparDadosSalvos(); // Limpa os dados salvos no JavaScript
                buscarDados();
            },
            error: function(error) {
                console.log('Erro ao excluir os dados.');
            }
        });
    } else {
        // O usuário cancelou a exclusão
        console.log("Exclusão cancelada pelo usuário.");
    }
}