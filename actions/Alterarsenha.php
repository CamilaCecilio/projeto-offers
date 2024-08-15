<?php
include "../conexaoBD.php";

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

    // Buscar a senha atual do usuário
    $sql = "SELECT senha FROM usuario WHERE id_usuario = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            die("Usuário não encontrado.");
        }

        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();


        // Verificar a senha atual
        if (strcmp($current_password, $stored_password) !== 0) {
            die("Senha atual incorreta.");
        }

        // Atualizar a senha no banco de dados
        $sql = "UPDATE usuario SET senha = ? WHERE id_usuario = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $new_password, $user_id);

            if ($stmt->execute()) {
                echo "Senha alterada com sucesso.";
            } else {
                echo "Erro ao alterar a senha: " . $stmt->error;
            }
            $stmt->close();
        } else {
            die("Erro ao preparar a consulta de atualização: " . $conn->error);
        }
    } else {
        die("Erro ao preparar a consulta de seleção: " . $conn->error);
    }

    $conn->close();
}
?>