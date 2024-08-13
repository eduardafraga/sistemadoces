<?php 
session_start();

if(!isset($_SESSION["id"])) {
    header("Location: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/suporte.css">
    <title>Duffet ● Suporte</title>
</head>
<body>
    <?php include_once "./components/header.php" ?>

    <section>
        <h2>Suporte ao cliente</h2>
        <span>Alguma dúvida sobre nossos produtos ou problemas com atendimento? Entre em contato conosco</span>
   
        <form action="" method="post">
            <input type="text" name="nome" placeholder="Nome">
            <input type="email" name="email" placeholder="Email">
            <textarea name="mensagem" id="Mensagem" rows="15" placeholder="Mensagem"></textarea>
            <input type="submit" value="Enviar" class="enviar">
        </form>

    </section>

    <?php include_once "./components/footer.php" ?>    
</body>
</html>