<?php
include_once("controller.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Simples</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylecheck.css">
    <link rel="shortcut icon" href="icone.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <div id="tudo">
        <div class="forms">
        <h1>Cadastro</h1>
            <form id="formularios">
                <label for="form1">Nome:</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="form1" class="form1" autocomplete="off">
                </div>
                <label for="form3">Email:</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="form3" class="form3" autocomplete="off">
                </div>
                <label for="form2">Telefone:</label>
                <div class="input-with-icon">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="form2" class="form2" autocomplete="off">
                </div>
                <input type="hidden" name="form4" class="form4" autocomplete="off">
                <label for="form5" class="label-maior">Maior de 18?</label>
                <input type="checkbox" name="form5" class="form5" id="maior" autocomplete="off">
                <div class="radios">
                    <label for="masc">
                        <input type="radio" name="gender" id="masc" class = "radio">
                        Masculino
                    </label>
                    <label for="fem">
                        <input type="radio" name="gender" id="fem" class = "radio">
                        Feminino
                    </label>
                </div>
                <input type="button" value="Salvar" class="btn" onclick="salvar()">
                <input type="reset" value="Limpar campos" class="btn" id="botaoReset">
                <input type="button" value="Excluir tudo" class="btn" onclick="excluirTudo()">
            </form>
        </div>
        <table id="minha-tabela">
            <tbody>
            </tbody>
        </table>
        <p id="printDados"></p>
        <script src="script.js"></script>
        <script>
            $(document).ready(function() {
                buscarDados();
            });
            const form = document.getElementById('formularios');
            form.addEventListener('reset', function() {
                //limpar também o input hidden.
                document.querySelector('.form4').value = '';
            });
        </script>
    </div>
</body>
</html>
