<?php
include "conexaoBD.php";
session_start();

if (isset($_POST['nome']) && isset($_SESSION['id_usuario'])) {
    $novo_nome = trim($_POST['nome']);
    if (empty($novo_nome)) {
        echo "O nome não pode estar vazio.";
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];

    $sql = "UPDATE usuario SET nome = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $novo_nome, $id_usuario);

    if ($stmt->execute()) {
        $_SESSION['nome'] = $novo_nome;
        echo "Nome atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o nome.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Dados inválidos.";
}
?>

