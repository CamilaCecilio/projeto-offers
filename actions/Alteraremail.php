<?php
session_start();
include "../conexaoBD.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit();
}

// Obtém o novo email do corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);
$novoEmail = $data['email'];

// Validação básica do email
if (!filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit();
}

// Atualiza o email no banco de dados
$id_usuario = $_SESSION['id_usuario'];
$sql = "UPDATE usuario SET email = :email WHERE id_usuario = :id_usuario";

try {
    $conexao = new Conexao();
    $conn = $conexao->conn; // Acessar a conexão PDO

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $novoEmail);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar email: ' . $e->getMessage()]);
}
?>
