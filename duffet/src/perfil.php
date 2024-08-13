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
    <link rel="stylesheet" href="./styles/perfil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <title>Duffet ● Perfil</title>
</head>
<body>
    <?php 
        include_once "./components/header.php";

        require_once realpath(__DIR__ . "/controllers/usuario/crudUsuario.php");
        
        $data = findOne();

        if(isset($_POST["update_perfil"])){
           
            $nperfil = $_FILES["imagem"];

            $local = "assets/perfil/";
            $image_name = $nperfil["name"];
            $extention = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $new_name = uniqid();
            $path = $local . $new_name . "." . $extention;
            $upload = move_uploaded_file($nperfil["tmp_name"], $path);
            
            if($upload){
                try{
                    updatePerfil($path);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }   
            } else {
                echo "<script> window.alert(\"Erro ao enviar arquivo\");</script>";
            }

            $data = findOne();
        }
    

        if(isset($_POST["update"])){
            $nnome = $_POST["nome"];
            $nsobrenome = $_POST["sobrenome"];
            $nemail = $_POST["email"];
            $nendereco = $_POST["endereco"];
            $ntelefone = $_POST["telefone"];


            try{
                update($nnome, $nsobrenome, $nemail, $nendereco, $ntelefone);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }   
            
            $data = findOne();
        }
    ?>

    <div class="container"> 
        <div class="menu">
            <menu>
                <ul>
                    <a href="./perfil.php"><li>
                        <div class="menu-icons">
                            <i class="fa-solid fa-user fa-2xl"></i>
                        </div>
                        <span>Perfil</span>
                    </li></a>        <a href="./carrinho.php"><li>
                        <div class="menu-icons">
                            <i class="fa-solid fa-folder fa-2xl"></i>
                        </div>
                        <span>Preferências</span>
                    </li></a>
                    <a href=""><li>
                        <div class="menu-icons">
                            <i class="fa-solid fa-bag-shopping fa-2xl"></i>
                        </div>
                        <span>Pedidos</span>
                    </li></a>
                    <a href="./carrinho.php"><li>
                        <div class="menu-icons">
                            <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                        </div>
                        <span>Carrinho</span>
                    </li></a>
                    <?php
                    $is_admin = $_SESSION["admin"]; 
                    if($is_admin == 1){
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
                    <a href="./controllers/login/logout.php" style="position: absolute; bottom: 30px"><li>
                        <div class="menu-icons">
                            <i class="fa-solid fa-right-from-bracket fa-2xl"></i>
                        </div>
                        <span>Sair</span>
                    </li></a>
                </ul>
            </menu>
        </div>
        <div class="info">
            <form enctype="multipart/form-data" method="post" class="foto-perfil">
                <img src="<?= $data["perfil"]?>" alt="Foto de perfil">
                <div class="edit">
                    <input type="file" name="imagem" id="imagem" style="visibility: hidden;" value="assets/profile.png" onchange="submitPhoto()">
                    <input name="update_perfil" style="visibility: hidden;">
                    <label for="imagem"><i class="fa-solid fa-pen edit"></i></label>
                </div>
            </form>
            <div class="dados">
                <span><?= $data["nome"] , " " , $data["sobrenome"]?></span>
            </div>
            <form action="" method="post">
                <h2>Alterar informações</h2>
                <div class="nome-sobrenome">
                    <div class="labels">
                        <label for="nome">Nome</label>
                        <label for="sobrenome">Sobrenome</label>
                    </div>
                    <div class="inputs">
                        <input type="text" name="nome" placeholder="Nome" value="<?= $data["nome"] ?>">
                        <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?= $data["sobrenome"] ?>">
                    </div>
                </div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" value="<?= $data["email"] ?>">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" placeholder="Nome" value="<?= $data["endereco"] ?>">
                <label for="endereco">Telefone</label>
                <input type="text" name="telefone" placeholder="Telefone" id="telefone" value="<?= $data["telefone"] ?>">
                <button class="enviar" name="update">Salvar Alterações</button>
            </form>
        </div>
    </div>
    
    <?php 
    include_once "./components/footer.php";
    ?>

    <script type="text/javascript">
        $("#telefone").mask("(00) 00000-0000");
        $("#cpf").mask("000.000.000-00");
    </script>

    <script>
        function submitPhoto(){

            setTimeout(() => {
                document.querySelector(".foto-perfil").submit();
            }, 1000);
        }
    </script>
</body>
</html>