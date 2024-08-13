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
    <link rel="stylesheet" href="./styles/produto.css">
    <title>Duffet ● Produto</title>
</head>
<body>
    <?php 
    include_once("./components/header.php");

    $info = findOneByIdProduto($_GET["id"]);
    ?>

    <form action="./carrinho.php" class="main-container" method="post">
        <input type="hidden" name="id_produto" value="<?= $info["id"]?>">
        <div class="produto">
            <img src="<?= $info["imagem"] ?? "./assets/cake-removebg-preview.png"?>" alt="bolo">
        </div>
        <div class="descricao">
            <h3><?= $info["nome"]?></h3>
            <span id="codigo">Codigo: <?= $info["id"]?></span>
            <p><?= $info["descricao"]?></p>
            <span id="preco">R$<?= str_replace(".", ",", $info["preco"])?></span>
            <h5>Tamanho</h5>
            <div class="tamanhos"> 
                <button type="button">
                    <input type="radio" name="tamanho" id="1" value="1" required><span>1</span>
                </button>
                <button type="button">
                    <input type="radio" name="tamanho" id="2" value="2" required><span>2</span>
                </button>
                <button type="button">
                    <input type="radio" name="tamanho" id="3" value="3" required><span>3</span>
                </button>
            </div>
            <h5>Quantidade</h5>
            <div class="cont">
                <input type="number" name="quantidade" min="1" max="<?= $info["quant_disponivel"]?>" value="1">
                <button name="add_cart" class="carrinho">Adicionar ao carrinho</button>
            </div>

        </div>
    </form>

    <div class="more-container">
        <h2>Nossos clientes também gostam</h2>
            <section class="more-produtos">

            <?php

            $bolos = findAllProduto();

            foreach( $bolos as $bolo ){
            ?>
                <form method="get" class="more-produto" action="./produto.php">
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
        const buttons = document.querySelectorAll('.tamanhos > button');

        const chooseSize = () => {
           buttons.forEach(button => {  
            if(button.classList.contains('active')){
               let radio = button.querySelector('input');
               radio.checked = true;
            }
           });
        }

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.contains('active') ? button.classList.remove('active') :
                button.classList.add('active', true);

                buttons.forEach(btn => btn !== button ? btn.classList.remove('active') : null);

                chooseSize();
            });
        });



    </script>
</body>
</html>
