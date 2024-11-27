

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&family=Poppins&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="css/mainLogin.css">

</head>

<div class="container">
        <div class="part_white_login">
            <form action="actions/insert.php" method="post" class="form_login">
                <h1>Crie sua conta</h1>

                <div class="input-label">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Digite seu nome">
                </div>

                <div class="input-label">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="exemplo@gmail.com">
                </div>

                <div class="input-label">
                    <label for="senha">Senha</label>
                    <div id="senha1" class="password-container">
                    <input type="password" id="senhaa" name="senha" placeholder="**********">
                    <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarsenha()"></i>
                    </div>
                </div>

                <div id="flex_final_form">
                    <a href="login.php">
                        <p>Já tem uma conta? <span>Entrar</span></p>
                    </a>
                    <button class="button_login" type="submit" name="submit">Cadastrar
                        <img src="../assets/icon_button.svg" alt="">
                    </button>
                </div>
            </form>
        </div>

        <!-- Adicionando a imagem ao lado -->
        <div class="image-container_login">
            <img src="assets/logooffers.png" alt="Descrição da imagem">
        </div>
    </div>
    <script src="../js/main.js"></script>
</body>

</html>