<?php 
session_start();
ini_set("display_errors", 1);

if(!isset($_SESSION["id"])) {
    header("Location: ./login.php");
}

require_once realpath(__DIR__ . "/controllers/carrinho/crudCarrinho.php");

if(isset($_POST["add_cart"])) {

    $id_produto = $_POST["id_produto"];
    $id_usuario = $_SESSION["id"];
    $quantidade = $_POST["quantidade"];
    $tamanho = $_POST["tamanho"];

    insertCarrinho($id_produto, $id_usuario, $quantidade, $tamanho);
}

if(isset($_POST["delete"])) {
    $id_produto = $_POST["id"];
    $id_usuario = $_SESSION["id"];
    deleteCarrinho($id_produto, $id_usuario);
}

$data = findAllCarrinho($_SESSION["id"]);
                    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/carrinho.css">
    <title>Duffet ● Carrinho</title>
</head>
<body>
    <?php 
        include_once "./components/header.php"
    ?>

    <div class="main-container">
        <div class="produtos">
            <?php 

            $total = 0; 

            foreach ($data as $produto) {
                $act = (float)$produto["preco"];
                $quantidade = (float)$produto["quantidade"];
                $tamanho = (float)$produto["tamanho"];
                $fator_tamanho = 1 + (0.03 * $tamanho);
                $total += ($act * $quantidade * $fator_tamanho);
            }

            foreach ($data as $produto) {
                switch ($produto["tamanho"]) {
                    case 1:
                        $letra_tamanho = "P";
                        break;
                    case 2:
                        $letra_tamanho = "M";
                        break;
                    case 3:
                        $letra_tamanho = "G";
                        break;
                }
            ?>
            <form method="post" action="" class="produto">
                <input type="hidden" name="id" value="<?= $produto["id"]?>">
                <div class="image">
                    <img src="./assets/cake-removebg-preview.png" alt="Produto 1">
                </div>
                <div class="info">
                    <h3><?= $produto["nome"]?></h3>
                    <p><?= $produto["descricao"]?></p>
                    <p style="display: flex; gap: 15px; align-items: center; color:rgb(124, 47, 47); font-size: 1.2rem; font-weight: 900;">
                        <input type="text" value="<?= $produto["quantidade"]?>" name="quantidade" class="quantidade" readonly>
                        <input type="text" value="<?= $letra_tamanho?>" class="quantidade" readonly>
                        R$<?= number_format((float)$produto["preco"], 2, ",", ".")?>
                    </p>
                </div>
                <button name="delete">Remover</button>
            </form>
            <?php }?>
        </div>

        <form action="" method="post" class="pagamento">
            <h2>Resumo do pedido</h2>
            <input type="hidden" name="valor_total" value="<?= $total?>">
            <span>R$ <?= number_format($total, 2, ",", ".")?></span>
            <button>Comprar</button>

            <hr style="margin-block: 15px; color:rgba(227, 230, 238, 0.6);">

            <h3 style="color:rgb(124, 47, 47)">Formas de pagamento</h3>
            <div class="formas-pagamento">
                <i class="fa-brands fa-cc-mastercard fa-2xl"></i>
                <i class="fa-brands fa-cc-visa fa-2xl"></i>
                <i class="fa-brands fa-cc-paypal fa-2xl"></i>
                <i class="fa-solid fa-barcode fa-2xl"></i>
                <i class="fa-brands fa-pix fa-2xl"></i>
                <i class="fa-brands fa-cc-apple-pay fa-2xl"></i>
            </div>
        </form> 
    </div>
    <?php 
    include_once "./components/footer.php";
    ?>

</body>
</html>