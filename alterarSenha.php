<?php
include "conexaoBD.php";
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
var_dump($_SESSION['id_usuario']);


if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/alterarsenha.css">
    <title>Offers</title>
</head>

<body>
    <form action="actions/Alterarsenha.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Senha atual</label>
            <input type="password" class="form-control" id="current_password" name="current_password">
            <label for="new_password" class="form-label">Nova Senha:</label>
            <input type="password" id="new_password" class="form-control" name="new_password" required>
            <label for="confirm_password" class="form-label">Confirmar Nova Senha:</label>
            <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
            <button type="submit" class="btn btn-primary">Alterar Senha</button>
        </div>
    </form>
</body>