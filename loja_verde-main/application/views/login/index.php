<?php
include_once("controle.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  <link rel="shortcut icon" href="../icone.png" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Login</title>
</head>
<body>
  <section>
    <div class="container" id="container1">
      <div class="login-box">
        <h1>Login</h1>
        <form>
          <div class="input-with-icon">
            <input type="text" id="usuarioLogin" class="formulario" placeholder="Nome de usuário" required autocomplete="off">
            <i class="fas fa-user"></i>
          </div>
          <div class="input-with-icon">
            <input type="password" id="senhaLogin" class="formulario" placeholder="Senha" required autocomplete="off">
            <i class="fas fa-lock"></i>
          </div>
          <div id="botoesLogin">
            <button type="button" id="btnLogin" class="btn" onclick = "logar()">Entrar</button>
            <button type="submit" id="btnEsqueci" class="btn" onclick="esqueciSenha()">Esqueci a senha</button>
          </div>
        </form>
      </div>
    </div>
    <div class="container" id="container2">
      <div class="login-box">
        <h1 id = "h1r">Registrar</h1>
        <form>
          <div class="input-with-icon">
            <input type="text" id="usuarioRegistrar" class="formulario" placeholder="Nome de usuário" required autocomplete="off">
            <i class="fas fa-user"></i>
          </div>
          <div class="input-with-icon">
            <input type="password" id="senhaRegistrar" class="formulario" placeholder="Senha" required autocomplete="off">
            <i class="fas fa-lock"></i>
          </div>
          <button type="button" id="btnRegistrar" class="btn" onclick="registrar()">Registrar</button>
        </form>
      </div>
    </div>
  </section>
  <script src="script.js"></script>
</body>
</html>
