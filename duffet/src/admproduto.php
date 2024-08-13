<?php
session_start();

require realpath(__DIR__ . "/controllers/produto/crudProduto.php");

if (!isset($_SESSION["id"]) || $_SESSION["admin"] !== 1) {
    header("Location: ./login.php");
}

if(isset($_POST["insert"])){
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $tipo = $_POST["tipo"];
    $sabor = $_POST["sabor"];
    $imagem = $_FILES["imagem"];
    
    $local = "assets/produtos/";
    $image_name = $imagem["name"];
    $extention = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $new_name = uniqid();
    $path = $local . $new_name . "." . $extention;
    $upload = move_uploaded_file($imagem["tmp_name"], $path);

    if($upload){
        try{
            insertProduto($nome, $descricao, $preco, $quantidade, $tipo, $sabor, $path);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }   
    } else {
        echo "<script> window.alert(\"Erro ao enviar arquivo\");</script>";
    }
    
}

if(isset($_POST["delete"])){
    $id = $_POST["id"];
    try{
        deleteProduto($id);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if(isset($_POST["update"])){
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $tipo = $_POST["tipo"];
    $sabor = $_POST["sabor"];
    // $imagem = $_FILES["imagem"];
    
    // $local = "assets/produtos/";
    // $image_name = $imagem["name"];
    // $extention = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    // $new_name = uniqid();
    // $path = $local . $new_name . "." . $extention;
    // $upload = move_uploaded_file($imagem["tmp_name"], $path);

    try{
        updateProduto($id, $nome, $descricao, $preco, $quantidade, $tipo, $sabor);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }   
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/admproduto.css">
    <title>Duffet ● ADM</title>
</head>

<body>
    <?php
    include_once "./components/header.php";
    ?>

    <div class="container">
        <div class="menu">
            <menu>
                <ul>
                    <a href="./perfil.php">
                        <li>
                            <div class="menu-icons">
                                <i class="fa-solid fa-user fa-2xl"></i>
                            </div>
                            <span>Perfil</span>
                        </li>
                    </a> <a href="./carrinho.php">
                        <li>
                            <div class="menu-icons">
                                <i class="fa-solid fa-folder fa-2xl"></i>
                            </div>
                            <span>Preferências</span>
                        </li>
                    </a>
                    <a href="">
                        <li>
                            <div class="menu-icons">
                                <i class="fa-solid fa-bag-shopping fa-2xl"></i>
                            </div>
                            <span>Pedidos</span>
                        </li>
                    </a>
                    <a href="./carrinho.php">
                        <li>
                            <div class="menu-icons">
                                <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                            </div>
                            <span>Carrinho</span>
                        </li>
                    </a>
                    <?php
                    $is_admin = $_SESSION["admin"];
                    if ($is_admin == 1) {
                        echo
                        "<details>
                            <summary>                        
                                <li>
                                    <div class='menu-icons'>
                                        <i class='fa-solid fa-lock'></i>
                                    </div>
                                    <span>Admin</span>
                                </li>
                            </summary>
                            
                                <a href='./admproduto.php'>Produtos</a>
                            
                        </details>";
                    }
                    ?>
                    <a href="./controllers/login/logout.php" style="position: absolute; bottom: 30px">
                        <li>
                            <div class="menu-icons">
                                <i class="fa-solid fa-right-from-bracket fa-2xl"></i>
                            </div>
                            <span>Sair</span>
                        </li>
                    </a>
                </ul>
            </menu>
        </div>
        <div class="info">
            <div>
                <h2>Produtos</h2>
                <?php 
                if(!isset($_GET["id"])){
                
                ?>
                <div class="pages">
                    <ul>
                        <li>
                            <input class="page" type="radio" id="newprod" name="aba" checked>
                            <label for="newprod">Novo Produto</label>
                            <div class="newproddiv">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="text" name="nome" id="nome" placeholder="Nome" required>

                                    <input type="text" name="descricao" id="descricao" placeholder="Descrição" required>

                                    <input type="text" name="preco" id="preco" placeholder="Preço" required>

                                    <input type="text" name="quantidade" id="quantidade" placeholder="Quantidade" required>

                                    <select name="tipo" id="tipo" aria-placeholder="Tipo">
                                        <option value="bolo">Bolos</option>
                                        <option value="doce">Doces</option>
                                        <option value="especial">Especiais</option>
                                    </select>

                                    <input type="text" name="sabor" id="sabor" placeholder="Sabor" required>

                                    <input type="file" name="imagem" id="imagem" placeholder="Imagem" required>

                                    <button type="submit" name="insert">Inserir</button>
                                </form>
                            </div>
                        </li>

                        <li>
                            <input class="page" type="radio" id="showprod" name="aba">
                            <label for="showprod">Ver Produtos</label>
                            <div class="showproddiv">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>Tipo</th>
                                            <th>Sabor</th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $produtos = findAllProduto();
                                    foreach ($produtos as $produto) { ?>
                                        <tr>
                                            <td class="prodinfo"><?= $produto["nome"] ?></td>
                                            <td class="prodinfo"><?= $produto["descricao"] ?></td>
                                            <td class="prodinfo"><?= $produto["preco"] ?></td>
                                            <td class="prodinfo"><?= $produto["quant_disponivel"] ?></td>
                                            <td class="prodinfo"><?= $produto["tipo"] ?></td>
                                            <td class="prodinfo"><?= $produto["sabor"] ?></td>
                                            <td>
                                                <form action="" method="get">
                                                    <input type="hidden" name="id" value="<?= $produto["id"]?>">

                                                    <button style="border: none; background-color: white;" name="update">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" value="<?= $produto["id"]?>">

                                                    <button style="border: none; background-color: white;" name="delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php } else { 
                    $produto = findOneByIdProduto($_GET["id"]);
                    
                    ?>
                    <div class="update-form">
                        <h3>Atualizar dados do produto</h3>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $produto["id"]?>">

                            <input type="text" name="nome" id="nome" placeholder="Nome do Produto" value="<?= $produto["nome"]?>" required>

                            <input type="text" name="descricao" id="descricao" placeholder="Descrição" value="<?= $produto["descricao"]?>" required>

                            <input type="text" name="preco" id="preco" placeholder="Preço" value="<?= $produto["preco"]?>" required>

                            <input type="text" name="quantidade" id="quantidade" placeholder="Quantidade disponivel" value="<?= $produto["quant_disponivel"]?>" required>

                            <select name="tipo" id="tipo" aria-placeholder="Tipo">
                                <option value="bolo" <?php if($produto["tipo"] == "bolo") echo "selected=\"selected\"" ?> >Bolos</option>
                                <option value="doce" <?php if($produto["tipo"] == "doce") echo "selected=\"selected\"" ?>>Doces</option>
                                <option value="especial" <?php if($produto["tipo"] == "especial") echo "selected=\"selected\"" ?>>Especiais</option>
                            </select>

                            <input type="text" name="sabor" id="sabor" placeholder="Sabor" value="<?= $produto["sabor"]?>" required>
                            <button type="submit" name="update">Atualizar os dados</button>
                        </form>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>

    <?php
    include_once "./components/footer.php";
    ?>

    <script>
        const buttons = document.querySelectorAll('.page');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.contains('active') ? button.classList.remove('active') :
                    button.classList.add('active', true);

                buttons.forEach(btn => btn !== button ? btn.classList.remove('active') : null);
            });
        });
    </script>
</body>

</html>