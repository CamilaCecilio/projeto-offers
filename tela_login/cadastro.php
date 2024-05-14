<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>

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

        <form action="insert.php" method="post" class="form_login">

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
                <input type="password" name="senha" placeholder="A senha deve ter 6 caracteres">
            </div>


            <div id="flex_final_form">
                <a href="login.php">
                    <p>Já tem uma conta? <span>Entrar</span></p>
                </a>


                <a href="index.php">

                    <button class="button_login" type="submit" name="submit"> Cadastrar   <img src="./assets_login/icon_button.svg" alt=""></button>
                  
                </a>
            </div>
        </form> 
    </div>

</body>

</html>