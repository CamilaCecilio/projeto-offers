<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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


    <link rel="stylesheet" href="style-login.css">

</head>

<body>

    <div class="part_white">

        <form action="POST" class="form_login">

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

            <a href="">

                <button class="button_login">Login In  <img src="./assets_login/seta-svg/ant-design_swap-left-outlined.svg" alt=""></button>
            </a>

            <a href="">
                <p>Ainda não tem uma conta? <span>Cadastrar</span></p>
            </a>
        </form>
    </div>

</body>

</html>