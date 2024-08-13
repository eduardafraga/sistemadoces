<?php 
session_start();

require_once "./controllers/usuario/crudUsuario.php";

if(isset($_POST["entrar"])){
    $email = $_POST["email"];
    $senha = hash("sha256", $_POST["senha"]);
    login($email, $senha);
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
    <title>Duffet ● Login</title>
</head>
<body>
    <div class="container">
        <div class="site-image">
            <img src="../public/DUFFET__2_-removebg-preview.png" alt="bolo">
        </div>
        <div class="form-section">
          <form action="" method="post">
            <h2>Faça seu login</h2>
            <input type="text" placeholder="Email" name="email" class="form-input" required>
            <input type="password" placeholder="Senha" name="senha" class="form-input" required id="pass">
           <input type="submit" value="Entrar" class="entrar" name="entrar">
            <a href="./cadastrar.php">Não possui uma conta? Criar conta</a>
          </form>       
        </div>
    </div>
</body>
</html>
