<?php
include "./conexaoBD.php";

if(isset($_POST['email']) || isset($_POST['senha'])) {

if(strlen($_POST['email']) == 0 && strlen($_POST['senha']) == 0 ) {
    echo "<div class='alert alert-danger'role='alert'> Preencha seu e-mail e senha! </div>";
} else if(strlen($_POST['email']) == 0) {
    echo "<div class='alert alert-danger'role='alert'> Preencha seu e-mail ! </div>";
}else if(strlen($_POST['senha']) == 0)
    echo "<div class='alert alert-danger'role='alert'> Preencha sua senha! </div>";
else {

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

    $quantidade = $sql_query->num_rows;

    if($quantidade == 1) {
        
        $usuario = $sql_query->fetch_assoc();

        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: ../index.php");

    } else {
        echo "<div class='alert alert-danger'role='alert'> Falha ao logar! E-mail ou senha incorretos </div>";
    }

}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&family=Poppins&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="styleLogin.css">

</head>

<body>

    <div class="part_white">

        <form action=" " method="POST" class="form_login">

            <h1>Login In</h1>

            <div class="input-label">
                <label for="email">E-mail</label>
                <input type="text" name="email" placeholder="exemplo@gmail.com">
            </div>

            <div class="input-label">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="***********">
            </div>

            <a href="">
                <p class="p_forgot">Esqueceu a senha?</p>
            </a>

            <a href="../index.php">
                <button class="button_login" type="submit">Login In <img src="./assets_login/icon_button.svg" alt=""></button>
            </a>

            <a href="cadastro.php">
                <p>Ainda não tem uma conta? <span>Cadastrar</span></p>
            </a>
        </form>
    </div>

</body>

</html>
