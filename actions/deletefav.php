<?php
include("../conexaoBD.php");

if (isset($_GET['produtoID'])) {
    $produtoID = $_GET['produtoID'];
    
    // Obtendo a conexão PDO
    $conexao = new Conexao();
    $pdo = $conexao->getConnection(); 

    try {
        // Preparando a instrução SQL
        $sql = "UPDATE produto SET favorito = 0 WHERE id_produto = :produtoID";
        $stmt = $pdo->prepare($sql); // Prepara a consulta
        $stmt->bindParam(':produtoID', $produtoID, PDO::PARAM_INT); // Liga o parâmetro do produto ID

        // Executando a consulta
        if ($stmt->execute()) {
            echo "Produto atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o produto.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
