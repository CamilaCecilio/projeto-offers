<?php
// Conexão com o banco de dados
include "../conexaoBD.php";

// Cria uma nova instância da classe de conexão
$conexao = new Conexao();
$pdo = $conexao->getConnection(); // Obtém a conexão PDO

if (isset($_GET['produtoID'])) {
    $produtoID = $_GET['produtoID'];
    $status = '';
    $saida = '';

    // Verifica o status do favorito e altera o valor
    if ($_GET['fav_status'] == 0) {
        $status = 1;
        $saida = 'favon';
    } else {
        $status = 0;
        $saida = 'favoff';
    }

    // Consulta SQL para atualizar o status do favorito
    $sql = "UPDATE produto SET favorito = :status WHERE id_produto = :produtoID";
    
    try {
        $stmt = $pdo->prepare($sql); // Prepara a consulta
        $stmt->bindParam(':status', $status, PDO::PARAM_INT); // Liga o parâmetro do status
        $stmt->bindParam(':produtoID', $produtoID, PDO::PARAM_INT); // Liga o parâmetro do produtoID
        $stmt->execute(); // Executa a consulta
        echo $saida; // Retorna o status de saída
    } catch (PDOException $e) {
        echo "Erro ao atualizar o favorito: " . $e->getMessage(); // Trata erro
    }
}
?>
