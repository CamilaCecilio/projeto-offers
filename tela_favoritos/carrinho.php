<?php
include '../conexaoBD.php';

if (!isset($_SESSION['itens'])) {
    $_SESSION['itens'] = array();
}

if (isset($_GET['add']) && $_GET['add'] == "carrinho") {
    $idProduto = (int) $_GET['id_Produto']; // Conversão para inteiro

    if (!isset($_SESSION['itens'][$idProduto])) {
        $_SESSION['itens'][$idProduto] = 1;
    } else {
        $_SESSION['itens'][$idProduto] += 1;
    }
}


if (empty($_SESSION['itens'])) {
    echo 'Carrinho Vazio <br><a href="../index.php">Adicionar itens</a>';
} else {
    // Preparando consulta SQL apenas uma vez
    $select = $conexao->prepare("SELECT * FROM produto WHERE id_Produto = :id");

    foreach ($_SESSION['itens'] as $idProduto) {
        $select->bindParam(':id', $idProduto, PDO::PARAM_INT);
        $select->execute();
        $produto = $select->fetch(PDO::FETCH_ASSOC); // Utilize fetch() para obter um único produto

        echo $produto["nome_produto"] . '<br/>
              Preço: ' . number_format($produto["preco"], 2, ",", ".") . '<br/>
              <a href="remover.php?remover=carrinho&id=' . $idProduto . '">Remover</a>
              <hr/>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>