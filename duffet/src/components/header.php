<div class="header-cont">
  <header>
    <nav>
      <img src="../public/DUFFET__2_-removebg-preview.png" alt="logo" class="logo">
      <ul>
        <li><a href="./index.php">Inicio</a></li>
        <li><a href="./suporte.php">Suporte</a></li>
        <li><a href="./produtos.php">Produtos</a></li>
        <li><a href="./carrinho.php">Carrinho</a></li>

      </ul>

      <?php
      require_once realpath(__DIR__ . '/../controllers/usuario/crudUsuario.php');

      if (!isset($_SESSION['id'])) {
        echo '<a href="./login.php"><button type="button" class="cadastrar">Login</button></a>';
      } else {
        $perfil = findOne();
        echo '<a href="./perfil.php" class="a-perfil"><img src="./' . $perfil["perfil"] . '" alt="Perfil" class="perfil"> <div class="hover-text">Perfil</div></a>';
      }
      ?>
    </nav>
  </header>
</div>