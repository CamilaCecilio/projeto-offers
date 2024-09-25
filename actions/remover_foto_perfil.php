<?php
include "../conexaoBD.php";
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['remover_foto'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Obter o caminho da foto de perfil atual
    $sql = "SELECT foto_perfil FROM usuario WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $foto_perfil_atual = $row['foto_perfil'];

        // Remover o arquivo da foto de perfil se existir
        if (!empty($foto_perfil_atual) && file_exists("../uploads_img/" . $foto_perfil_atual)) {
            unlink("../uploads_img/" . $foto_perfil_atual);
        }

        // Atualizar o banco de dados para remover a foto
        $sql = "UPDATE usuario SET foto_perfil = NULL WHERE id_usuario = $id_usuario";
        try {
            $conn->query($sql);
            header("Location: ../perfil.php"); // Redireciona para a página de perfil após a remoção
            exit();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Foto de perfil não encontrada.</div>";
    }
}
?>