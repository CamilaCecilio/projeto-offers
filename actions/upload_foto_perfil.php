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
        $foto_nome = preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES["foto_perfil"]["name"]));
        $foto_destino = "../uploads_img/" . $foto_nome;
        $foto_destino_novo = str_replace("../", "", $foto_destino);

        // Verificar se o diretório de uploads existe, se não, cria
        if (!file_exists('../uploads_img')) {
            mkdir('../uploads_img', 0777, true);
        }

        // Verificar se o arquivo é uma imagem
        $check = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
        if ($check === false) {
            echo "<div class='alert alert-danger' role='alert'>O arquivo não é uma imagem.</div>";
            exit();
        }

        // Verificar o tamanho do arquivo (por exemplo, máximo de 2MB)
        if ($_FILES["foto_perfil"]["size"] > 2 * 1024 * 1024) {
            echo "<div class='alert alert-danger' role='alert'>O arquivo é muito grande. Máximo permitido é 2MB.</div>";
            exit();
        }

        // Permitir somente certos formatos
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($foto_nome, PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_types)) {
            echo "<div class='alert alert-danger' role='alert'>Somente arquivos JPG, JPEG, PNG e GIF são permitidos.</div>";
            exit();
        }

        // Mover o arquivo para o diretório de destino
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
