<?php 

function findAllProduto() {
    require realpath(__DIR__ . "/../../database/conection.php");
    $sql = "SELECT * FROM produto";
    $stm = $conn->prepare($sql);
    try {
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function findOneByIdProduto($id) {
    require realpath(__DIR__ . "/../../database/conection.php");
    $sql = "SELECT * FROM produto WHERE id = :id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id", $id, PDO::PARAM_INT);
    try {
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    
}

function insertProduto ($nome, $descricao, $preco, $quantidade, $tipo, $sabor, $imagem) {
    require realpath(__DIR__ . "/../../database/conection.php");
    if(isset($_POST["insert"])){
        $sql = "INSERT INTO produto VALUES (DEFAULT, :nome, :preco, :descricao, :quantidade, :tipo , :sabor, :imagem)";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stm->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        $stm->bindParam(":preco", $preco);
        $stm->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);
        $stm->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stm->bindParam(":sabor", $sabor, PDO::PARAM_STR);
        $stm->bindParam(":imagem", $imagem);

        try {
            return $stm->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

function deleteProduto($id) {
    require realpath(__DIR__ . "/../../database/conection.php");
    $sql = "DELETE FROM produto WHERE id = :id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id", $id, PDO::PARAM_INT);
    try {
        return $stm->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function updateProduto($id, $nome, $descricao, $preco, $quantidade, $tipo, $sabor) {
    require realpath(__DIR__ . "/../../database/conection.php");
    $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, quant_disponivel = :quantidade, tipo = :tipo, sabor = :sabor WHERE id = :id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id", $id, PDO::PARAM_INT);
    $stm->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stm->bindParam(":descricao", $descricao, PDO::PARAM_STR);
    $stm->bindParam(":preco", $preco);
    $stm->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);
    $stm->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stm->bindParam(":sabor", $sabor, PDO::PARAM_STR);
    try {
        return $stm->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}