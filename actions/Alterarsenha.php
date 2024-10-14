<?php
// Conexão com o banco de dados
include "../conexaoBD.php";

$conexao = new Conexao(); // Cria uma nova instância da classe de conexão
$pdo = $conexao->conn; // Obtém a conexão PDO

// Iniciar a sessão para acessar o ID do usuário
session_start();

// Verificar se o usuário está autenticado (substitua conforme sua lógica de autenticação)
if (!isset($_SESSION['id_usuario'])) {
    die("Usuário não autenticado.");
}

$user_id = $_SESSION['id_usuario'];

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar e validar entradas
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        die("Por favor, preencha todos os campos.");
    }

    if ($new_password !== $confirm_password) {
        die("A nova senha e a confirmação da senha não coincidem.");
    }

    try {
        // Buscar a senha atual do usuário
        $sql = "SELECT senha FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se o usuário foi encontrado
        if ($stmt->rowCount() === 0) {
            die("Usuário não encontrado.");
        }

        $stored_password = $stmt->fetchColumn(); // Obtém a senha armazenada

        // Verificar a senha atual
        if (strcmp($current_password, $stored_password) !== 0) {
            die("Senha atual incorreta.");
        }

        // Atualizar a senha no banco de dados
        $sql = "UPDATE usuario SET senha = :new_password WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':new_password', $new_password);
        $stmt->bindParam(':id_usuario', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Senha alterada com sucesso.";
        } else {
            echo "Erro ao alterar a senha.";
        }
    } catch (PDOException $e) {
        die("Erro ao processar a solicitação: " . $e->getMessage());
    }
}
?>
