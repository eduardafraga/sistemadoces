<?php 
session_start();
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duffet</title>
    <link rel="shortcut icon" href="../public/DUFFET__2_-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/globals.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>
  <div class="container">
    
    <?php 
      include_once './components/header.php';
    ?>
    <main>
        <div>
            <h2>Seja Bem-Vindo ao Duffet!</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam sequi provident earum odio odit itaque doloremque ipsa libero, sint cumque? Hic distinctio illum deserunt aliquid numquam. Atque fuga modi dolor?</p>
            <a href="#"><button onclick="goToProduct()">Conheça nossos produtos</button></a>
            
        </div>
        <img src="../public/DUFFET__2_-removebg-preview.png" alt="cake">

    </main>
    <section class="trending">
        <h2>Recomendados</h2>
        <span>Os bolos e doces preferidos dos nossos clientes</span>
        <div>
            <ul>
                <?php 

                require_once realpath(__DIR__ . '/controllers/produto/crudProduto.php');

                $data = findAllProduto();
                
                for ($i = 0; $i < 3; $i++) {
                ?>

                <li><a href="./produto.php?id=<?= $data[$i]["id"]?>" class="produto-link"><div class="produtos">
                    <img src="<?= $data[$i]["imagem"] ?? "./assets/cake-removebg-preview.png"?>" alt="Imagem do produto">
                    <span><?= $data[$i]["descricao"]?></span>
                </div></a></li>

               <?php }?>
            </ul>
        </div>
    </section>
    <section class="reviews">
        <h2 style="margin-bottom: 60px; color: rgb(172, 63, 63); font-weight: bolder; font-size: 2.5rem">Reviews de bolos</h2>
        <div class="box"> 
            <img src="./assets/perfil.jpg" alt="Foto de perfil" class="perfil-review">
            <div class="inter">
                <h3> Fernanda Firmo</h3>
                <div style="display: flex; justify-content:center; margin-bottom: 10px;">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur nam voluptatum assumenda, ipsa adipisci tenetur omnis illum minus optio, fugiat tempore sunt labore possimus molestias officia dolorem, enim obcaecati illo?
                </span>
            </div>
        </div>
        <div class="box"> 
            <img src="./assets/perfil2.jpg" alt="Foto de perfil" class="perfil-review">
            <div class="inter">
                <h3> Mariana Magalhães</h3>
                <div style="display: flex; justify-content: center; margin-bottom: 10px">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur nam voluptatum assumenda, ipsa adipisci tenetur omnis illum minu
                </span>
            </div>
        </div>
    </section>
    <?php 
    include_once "./components/footer.php";
    ?>
  </div>


  <script>
    const goToProduct = () => {
        window.location.href = './produtos.php';
    }
  </script>
</body>
</html>
