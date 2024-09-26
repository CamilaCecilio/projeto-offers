<?php
session_start();
include "../conexaoBD.php"; // Certifique-se de incluir a classe de conexão

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['remover_foto'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Cria uma nova instância da classe de conexão
    $conexao = new Conexao();
    $pdo = $conexao->getConnection(); // Obtém a conexão PDO

    // Obter o caminho da foto de perfil atual
    $sql = "SELECT foto_perfil FROM usuario WHERE id_usuario = :id_usuario";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $foto_perfil_atual = $row['foto_perfil'];

            // Remover o arquivo da foto de perfil se existir
            if (!empty($foto_perfil_atual) && file_exists("../uploads_img/" . $foto_perfil_atual)) {
                unlink("../uploads_img/" . $foto_perfil_atual);
            }

            // Atualizar o banco de dados para remover a foto
            $sql = "UPDATE usuario SET foto_perfil = NULL WHERE id_usuario = :id_usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: ../perfil.php"); // Redireciona para a página de perfil após a remoção
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Foto de perfil não encontrada.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar: " . $e->getMessage() . "</div>";
    }
}
?>