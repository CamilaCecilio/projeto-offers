<?php
include "conexaoBD.php";
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
}

$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap"
        rel="stylesheet"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&display=swap"
        rel="stylesheet"> <!-- FONTE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="actions/insertProduto.php"> <!-- ARQUIVO INSERT -->
    <link rel="stylesheet" href="css/perfil.css"> <!-- CSS -->
    <title>Offers</title>
    <style>
        .cadastro-link {
            color: black;
        }
        .password-hidden {
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            letter-spacing: 0.3em;
        }
    </style>
</head>

<body>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li><h1> <?php echo $_SESSION['nome'] ?>! Olá, aqui é a sua conta :)</h1></li>
    <li class="list-group-item"><h3><a href="#" id="cadastro-button" class="cadastro-link">Cadastro</a></h3></li>
    <li class="list-group-item" id="dados-conta" style="display: none;">
        <h3>Dados da conta</h3>
        <?php 
        if ($user_data = mysqli_fetch_assoc($result)) {
            echo "<h5>Email:</h5>";
            echo "<td>" . $user_data["email"] . "</td><br>";
            echo "<h5>Senha:</h5>";
            echo "<td>" . $user_data["senha"] . "</td>";
            echo "<h5>Nome de usuario:</h5>";
            echo "<td>" . $user_data["nome"] . "</td>";
        } else {
            echo "<td>Erro ao buscar dados</td>";
        }
        ?>
    </li>
  </ul>
</div>
</body>
</html>


<script>
document.getElementById('cadastro-button').addEventListener('click', function() {
    var dadosConta = document.getElementById('dados-conta');
    if (dadosConta.style.display === 'none') {
        dadosConta.style.display = 'block';
    } else {
        dadosConta.style.display = 'none';
    }
});
</script>
</body>
</html>



