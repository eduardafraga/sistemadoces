<?php 

function insert($cpf, $nome, $sobrenome, $email, $senha, $endereco, $telefone) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["cadastrar"])){
        $sql = "INSERT INTO usuario VALUES (DEFAULT, :cpf, :nome, :sobrenome, :email, :senha, :endereco, :telefone, DEFAULT, DEFAULT)";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $stm->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stm->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
        $stm->bindParam(":email", $email, PDO::PARAM_STR);
        $stm->bindParam(":senha", $senha, PDO::PARAM_STR);
        $stm->bindParam(":endereco", $endereco, PDO::PARAM_STR);
        $stm->bindParam(":telefone", $telefone, PDO::PARAM_STR);

        try {
            $stm->execute();
            header("Location: ./index.php");
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

function update($nome, $sobrenome, $email, $endereco, $telefone) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["update"])){
        $sql = "UPDATE usuario SET nome=:nome, sobrenome=:sobrenome, email=:email, endereco=:endereco, telefone=:telefone WHERE id=:id";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stm->bindParam(":email", $email, PDO::PARAM_STR);
        $stm->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
        $stm->bindParam(":endereco", $endereco, PDO::PARAM_STR);
        $stm->bindParam(":telefone", $telefone, PDO::PARAM_STR);
        $stm->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);

        try {
            return $stm->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

function updatePerfil(string $perfil) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["update_perfil"])){
        $sql = "UPDATE usuario SET perfil=:perfil WHERE id=:id";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":perfil", $perfil);
        $stm->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);

        try {
            return $stm->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

function delete($nome, $email) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["deletar"])){
        $sql = "DELETE FROM usuario WHERE nome = :nome AND email = :email";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stm->bindParam(":email", $email, PDO::PARAM_STR);
        try {
            $result = $stm->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return $result;
    }
}

function findOne() {
    require realpath(__DIR__ . "/../../database/conection.php");
    
    $sql = "SELECT nome, sobrenome, email, endereco, telefone, perfil FROM usuario WHERE id = :id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id", $_SESSION["id"]);

    try {
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }

    return $result;
}

function login($email, $senha) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["entrar"])){
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":email", $email, PDO::PARAM_STR);
        $stm->bindParam(":senha", $senha, PDO::PARAM_STR);
        try {
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if($result){
                session_start();
                $_SESSION["id"] = $result["id"];
                $_SESSION["nome"] = $result["nome"];
                $_SESSION["email"] = $result["email"];
                $_SESSION["senha"] = $result["senha"];
                $_SESSION["admin"] = $result["is_admin"];
                header("Location: ./index.php");
            } else {
                return "Usuário ou senha inválidos";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}