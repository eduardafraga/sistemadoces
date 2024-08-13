<?php 
session_start();
ini_set("display_errors", 1);

require_once realpath(__DIR__ . "/controllers/produto/crudProduto.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/produtos.css">
    <title>Duffet ● Produtos</title>
</head>
<body>
    <?php 
        include_once("./components/header.php")
    ?>
    <section class="tipos">
        <ul>
            <li><button class="tipo">Bolos</button></li>
            <li><button class="tipo">Doces</button></li>
            <li><button class="tipo">Especiais</button></li>
        </ul>
    </section>

    <div class="main-container">
        <h2>Bolos 🍰</h2>
        <section class="produtos">
        <?php

        $bolos = findAllProduto();
        
        foreach( $bolos as $bolo ){
        ?>
            <form method="get" class="produto" action="./produto.php">
                <input type="hidden" value="<?= $bolo["id"]?>" name="id">
                <img src="<?= $bolo["imagem"] ?? "./assets/cake-removebg-preview.png"?>" alt="bolo">
                <span class="nome_bolo"><?php echo $bolo["nome"]; ?></span>
                <div>
                    <span>R$<?php echo str_replace(".", ",", $bolo["preco"]); ?></span>
                    <button><i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </form>
        <?php }?>
        </section>

        <h2>Doces 🍮</h2>
        <section class="produtos">
        <?php
        
        foreach( $bolos as $bolo ){
            ?>
            <form method="get" class="produto" action="./produto.php">
                <input type="hidden" value="<?= $bolo["id"]?>" name="id">
                <img src="<?= $bolo["imagem"] ?? "./assets/cake-removebg-preview.png"?>" alt="bolo">
                <span class="nome_bolo"><?php echo $bolo["nome"]; ?></span>
                <div>
                    <span>R$<?php echo str_replace(".", ",", $bolo["preco"]); ?></span>
                    <button><i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </form>
        <?php }?>
        </section>

        <h2>Especiais ✨</h2>
        <section class="produtos">
        <?php
        
        foreach( $bolos as $bolo ){
            ?>
            <form method="get" class="produto" action="./produto.php">
                <input type="hidden" value="<?= $bolo["id"]?>" name="id">
                <img src="<?= $bolo["imagem"] ?? "./assets/cake-removebg-preview.png"?>" alt="bolo">
                <span class="nome_bolo"><?php echo $bolo["nome"]; ?></span>
                <div>
                    <span>R$<?php echo str_replace(".", ",", $bolo["preco"]); ?></span>
                    <button><i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </form>
        <?php }?>
        </section>
    </div>

    <?php 
    include_once "./components/footer.php";
    ?>

    <script>
        const buttons = document.querySelectorAll('.tipo');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.contains('active') ? button.classList.remove('active') :
                button.classList.add('active', true);

                buttons.forEach(btn => btn !== button ? btn.classList.remove('active') : null);
            });
        });

        function truncateText(selector, maxLength) {
            const elements = document.querySelectorAll(selector);

            elements.forEach(element => {
                
                let text = element.innerText;
                
                if (text.length > maxLength) {
                    text = text.substring(0, maxLength) + '...';
                }
                
                element.innerText = text;
            });
        }

        truncateText('.nome_bolo', 30);
    </script>
</body>
</html>
