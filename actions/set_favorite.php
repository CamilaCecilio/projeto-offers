<?php
// Conexão com o banco de dados
include "../conexaoBD.php";

// Cria uma nova instância da classe de conexão
$conexao = new Conexao();
$pdo = $conexao->getConnection(); // Obtém a conexão PDO

if (isset($_GET['produtoID'])) {
    $produtoID = $_GET['produtoID'];

    // Consulta SQL para obter o status atual do favorito
    $sql = "SELECT favorito FROM produto WHERE id_produto = :produtoID";
    
    try {
        $stmt = $pdo->prepare($sql); // Prepara a consulta
        $stmt->bindParam(':produtoID', $produtoID, PDO::PARAM_INT); // Liga o parâmetro do produtoID
        $stmt->execute(); // Executa a consulta
        
        // Verifica se o produto existe e obtém o status atual
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $currentStatus = $row['favorito'];

            // Altera o status do favorito
            $newStatus = ($currentStatus == 1) ? 0 : 1; // Alterna o status
            $saida = ($newStatus == 1) ? 'favon' : 'favoff'; // Define a saída

            // Atualiza o status do favorito no banco de dados
            $updateSql = "UPDATE produto SET favorito = :status WHERE id_produto = :produtoID";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':status', $newStatus, PDO::PARAM_INT); // Liga o parâmetro do status
            $updateStmt->bindParam(':produtoID', $produtoID, PDO::PARAM_INT); // Liga o parâmetro do produtoID
            $updateStmt->execute(); // Executa a atualização
            
            echo $saida; // Retorna o status de saída
        } else {
            echo "Produto não encontrado."; // Trata caso em que o produto não existe
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar o favorito: " . $e->getMessage(); // Trata erro
    }
}
?>
