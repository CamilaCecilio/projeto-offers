<?php

// Recebe e limpa os dados do formulário
$produto = trim($_POST['nome_produtolista']);
$tipo = $_POST['tipo_produtolista'];
$quantidade = $_POST['quantidade_produtolista'];

// Verificar se os campos de produto e quantidade são válidos
if (empty($produto) || $quantidade <= 0) {
    // Redirecionar de volta com uma mensagem de erro
    header("Location: lista.php?resposta=error&mensagem=" . urlencode("Por favor, adicione um nome de produto e uma quantidade maior que zero."));
    exit;
}

try {
    // Abrir conexão com o banco
    $pdo = new PDO('mysql:host=localhost;dbname=bdoffersfast', 'root', '');
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparação da Query
    $sql = "INSERT INTO produtolista (nome_produtolista, tipo_produtolista, quantidade_produtolista) VALUES (:nome_produtolista, :tipo_produtolista, :quantidade_produtolista)";

    // Preparar a query
    $stmt = $pdo->prepare($sql);

    // Vincular parâmetros
    $stmt->bindParam(':nome_produtolista', $produto, PDO::PARAM_STR);
    $stmt->bindParam(':tipo_produtolista', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':quantidade_produtolista', $quantidade, PDO::PARAM_INT);

    // Executar a query
    $stmt->execute();
    
    // Redirecionar com sucesso
    header("Location: lista.php?resposta=success");
} catch (PDOException $e) {
    // Em caso de erro, redirecionar com a mensagem de erro
    header("Location: lista.php?resposta=" . urlencode($e->getMessage()));
    exit;
}
?>

