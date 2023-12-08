// Variável global para armazenar os dados do login
let dadosSalvos = [];

function logar() {
    // Obter os valores de login e senha
    let usuario = document.querySelector('#usuarioLogin').value;
    let senha = document.querySelector('#senhaLogin').value;
    // Criar um objeto com os dados do usuário
    let user = {
      usuario: usuario,
      senha: senha
    };

    // Armazenar os dados do usuário na variável global
    dadosSalvos.push(user);

    // Exemplo de exibição dos dados no console
    console.log(dadosSalvos);
    $.ajax({
      url: 'controle.php',
      method: 'POST',
      data: {
        buscar_dados: true,
        dados: JSON.stringify(dadosSalvos)
      },
      success: function(response) {
        console.log('usuario existe:', response);
        if(response == "false"){
          alert("Usuário inválido !");
          return;
        }
        window.location.href = '../pagInicial/crud.php';
      },
      error: function(error) {
        console.log('Erro ao verificar o usuário:', error);
        alert("Ocorreu um erro ao verificar o usuário.");
      }
    });
    limparDadosSalvos();
  ; // <-- Adicione esta linha para fechar a função interna
  
}

function limparDadosSalvos() {
  dadosSalvos = []; // Limpa o array de dados salvos no JavaScript
}

function esqueciSenha(){
    window.location.href = '../pagInicial/crud.php';
}

function registrar() {
    let usuario = document.querySelector('#usuarioRegistrar').value;
    let senha = document.querySelector('#senhaRegistrar').value;
    if(usuario === '' || senha === ''){
      alert("Preencha ambos os campos!");
      return;
  }
    // Criar um objeto com os dados do usuário a serem enviados
    let user = {
      usuario: usuario,
      senha: senha
    };
  
    // Enviar os dados do usuário para o servidor usando AJAX
    $.ajax({
      url: 'controle.php',
      method: 'POST',
      data: {
        registrar_usuario: true,
        dados: JSON.stringify(user)
      },
      success: function(response) {
        console.log('Usuário registrado:', response);
        alert("Usuário registrado com sucesso !");
      },
      error: function(error) {
        console.log('Erro ao registrar o usuário:', error);
       
      }
    });
}
