<?php
include "../conexaoBD.php";
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['submit'])) {
    if (empty($_FILES['foto_perfil']['name'])) {
        echo "<div class='alert alert-danger' role='alert'>Por favor, selecione uma foto!</div>";
    } else {
        $id_usuario = $_SESSION['id_usuario'];
        $foto_nome = $_FILES["foto_perfil"]["name"];
        $foto_destino = "../uploads_img/" . $foto_nome;
        $foto_destino_novo = str_replace("../", "", $foto_destino);

        if (!file_exists('../uploads_img')) {
            mkdir('../uploads_img', 0777, true);
        }

        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $foto_destino)) {
            $sql = "UPDATE usuario SET foto_perfil='$foto_destino_novo' WHERE id_usuario = $id_usuario";
            try {
                $conn->query($sql);
                header("Location: ../perfil.php"); // Redireciona para a página de perfil após o upload
                exit();
            } catch (Exception $e) {
                echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao mover o arquivo para o destino!</div>";
        }
    }
}
?>

