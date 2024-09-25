<?php
include "../conexaoBD.php"; // Inclui a classe de conexão

try {
    // Cria uma instância da classe de conexão
    $conexao = new Conexao(); // Supondo que a classe de conexão é chamada Conexao
    $pdo = $conexao->conn; // Obtendo a conexão

    // Verifica se a pesquisa foi enviada
    if (isset($_POST['search'])) {
        $searchTerm = strtolower($_POST['search']); // Termo de pesquisa

        // Verifica se a conexão foi estabelecida
        if ($pdo) {
            // Consulta SQL com LIKE para buscar produtos
            $sql = "SELECT * FROM produto WHERE LOWER(nome_produto) LIKE :searchTerm";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%'); // Usa wildcards para buscar parte do termo
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca os resultados

            if ($results) {
                echo "<h3>Resultados da pesquisa:</h3>";
                echo "<ul>";
                foreach ($results as $row) {
                    echo "<li>" . htmlspecialchars($row['nome_produto']) . " - R$ " . number_format($row['preco'], 2, ',', '.') . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
        } else {
            echo "<p>Erro na conexão com o banco de dados.</p>";
        }
    } else {
        echo "<p>Nenhum termo de pesquisa foi fornecido.</p>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
