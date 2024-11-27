<?php
// Inclui a classe de conexão
include "conexaoBD.php";

// Cria uma instância da classe Conexao
$conexao = new Conexao();

// Obtém a conexão PDO
$conn = $conexao->getConnection();

// Verifica se o formulário foi enviado
if (isset($_POST['email']) || isset($_POST['senha'])) {

    // Verifica se os campos estão preenchidos
    if (strlen($_POST['email']) == 0 && strlen($_POST['senha']) == 0) {
        echo "<div class='alert alert-danger' role='alert'>Preencha seu e-mail e senha!</div>";
    } else if (strlen($_POST['email']) == 0) {
        echo "<div class='alert alert-danger' role='alert'>Preencha seu e-mail!</div>";
    } else if (strlen($_POST['senha']) == 0) {
        echo "<div class='alert alert-danger' role='alert'>Preencha sua senha!</div>";
    } else {
        // Obtém e filtra os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Prepara a consulta usando placeholders para evitar injeção de SQL
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";

        try {
            // Prepara a declaração
            $stmt = $conn->prepare($sql);

            // Vincula os parâmetros de forma segura
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

            // Executa a consulta
            $stmt->execute();

            // Obtém o número de linhas retornadas
            $quantidade = $stmt->rowCount();

            if ($quantidade == 1) {
                // Busca o usuário
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Inicia a sessão, se não estiver iniciada
                if (!isset($_SESSION)) {
                    session_start();
                }

                // Armazena as informações do usuário na sessão
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome'] = $usuario['nome'];

                // Redireciona para a página inicial
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Falha ao logar! E-mail ou senha incorretos</div>";
            }
        } catch (PDOException $e) {
            // Exibe o erro em caso de falha na execução
            echo "<div class='alert alert-danger' role='alert'>Erro ao executar a consulta: " . $e->getMessage() . "</div>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&family=Poppins&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="css/mainLogin.css">

</head>

<body>
<div class="container">
    <div class="part_white_login">
        <form action="" method="POST" class="form_login">
            <h1>Login In</h1>

            <div class="input-label">
                <label for="email">E-mail</label>
                <input type="text" name="email" placeholder="exemplo@gmail.com">
            </div>

            <div class="input-label">
                <label for="senha">Senha</label>
                <div id="senha1" class="password-container">
                    <input type="password" id="senhaa" name="senha" placeholder="**********">
                    <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarsenha()"></i>
                </div>
            </div>

            <a href="" class="forgot-password-link">
                <p class="p_forgot">Esqueceu a senha?</p>
            </a>

            <a href="index.php">
                <button class="button_login" type="submit">Login In 
                    <img src="../assets/icon_button.svg" alt="">
                </button>
            </a>

            <a href="cadastro.php">
                <p>Ainda não tem uma conta? <span>Cadastrar</span></p>
            </a>
        </form>
    </div>

    <div class="image-container_login">
        <img src="assets/logooffers.png" alt="Descrição da imagem">
    </div>
</div>

    
<script src="js/main.js"></script>
</body>

</html>
