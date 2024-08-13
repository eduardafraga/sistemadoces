<?php 
require_once "./controllers/usuario/crudUsuario.php";

if(isset($_POST["cadastrar"])){
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $senha = hash("sha256", $_POST["senha"]);

    insert($cpf, $nome, $sobrenome, $email, $senha, $endereco, $telefone);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <title>Duffet ● Cadastrar</title>
</head>
<body>
    <div class="container">
        <div class="site-image">
            <img src="../public/DUFFET__2_-removebg-preview.png" alt="bolo">
        </div>
        <div class="form-section">
            <form action="" method="post">
              <h2>Faça seu cadastro</h2>
              <input type="text" placeholder="Nome" name="nome" class="form-input" required>
              <input type="text" placeholder="Sobrenome" name="sobrenome" class="form-input" required>
              <input type="text" placeholder="CPF" name="cpf" class="form-input" id="cpf" required>
              <input type="email" placeholder="Email" name="email" class="form-input" required>
              <input type="text" placeholder="Endereço" name="endereco" class="form-input" required>
              <input type="text" placeholder="Telefone" name="telefone" class="form-input" id="telefone" required>
              <input type="password" placeholder="Senha" name="senha" class="form-input" required id="pass">
              <input type="submit" value="Entrar" class="entrar" name="cadastrar">
              <a href="./login.php">Já possui uma conta? Fazer login</a>
            </form>        
        </div>
    </div>
    <script type="text/javascript">
        $("#telefone").mask("(00) 00000-0000");
        $("#cpf").mask("000.000.000-00");
    </script>
</body>
</html>
