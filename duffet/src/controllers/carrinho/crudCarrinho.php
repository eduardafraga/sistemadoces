<?php

function insertCarrinho($id_produto, $id_usuario, $quantidade, $tamanho)
{
    require realpath(__DIR__ . '/../../database/conection.php');
    $sql = "INSERT INTO carrinho VALUES (:id_produto, :id_usuario, :quantidade, :tamanho)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);
    $stm->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stm->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);
    $stm->bindParam(":tamanho", $tamanho, PDO::PARAM_INT);

    try {
        return $stm->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function findAllCarrinho($id_usuario)
{
    require realpath(__DIR__ . '/../../database/conection.php');

    $sql = "SELECT * FROM carrinho INNER JOIN produto ON carrinho.id_produto = produto.id WHERE carrinho.id_usuario = :id_usuario;";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

    try {
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteCarrinho($id_produto, $id_usuario)
{
    require realpath(__DIR__ . '/../../database/conection.php');
    $sql = "DELETE FROM carrinho WHERE id_produto = :id_produto AND id_usuario = :id_usuario";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);
    $stm->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

    try {
        return $stm->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
