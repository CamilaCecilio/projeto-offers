<?php
// Conexão com o banco de dados
include "conexaoBD.php";

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Consulta SQL para obter os detalhes do produto pelo ID
    $sql = "SELECT * FROM produto WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o produto foi encontrado
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID do produto não fornecido.";
    exit;
}

$limite = 6;
$contador = 0;

session_start(); // Inicia a sessão (se já não estiver iniciada)

if (isset($_SESSION['nome'])) {
    $nomeUsuario = '<a>' . $_SESSION['nome'] . '</a>'; // Insere o nome do usuário dentro da tag <a>
    $mostrarLogout = true; // Define como verdadeiro para mostrar o dropdown de logout
} else {
    $nomeUsuario = '<a href="login.php">Login</a>'; // Define um link de login como padrão se o usuário não estiver logado
    $mostrarLogout = false; // Define como falso para não mostrar o dropdown de logout
}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/infoProduto.css"> <!-- CSS -->
    <title>Detalhes do Produto</title>
</head>

<body>
<div id="headid">
        <div id="menu">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
            </svg>
        </div>
        <div id="home">
            <div class="text">
                <a href="index.php">
                    <h6>Home</h6>
                </a>
            </div>
            <div class="text">
                <h6 href="" class="dropdown">Produtos <ul class="dropdown-menu">
                        <a href="cadastroProduto.php">
                            <li class="add-link">Adicionar Oferta</li>
                        </a>
                    </ul>
                </h6>
            </div>
            <input class="input" name="text" type="text" placeholder="Pesquisar Produto">
        </div>
        <div id="icons">
            <a href="favoritos.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff"
                        d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                </svg></a>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
            </svg>
            <div id="login">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="login-icon">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff"
                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                </svg>
                <ul>
                    <li class="dropdown">
                        <?php echo $nomeUsuario; ?>
                        <div class="dropdown-menu">
                            <?php if ($mostrarLogout) { ?>
                                <a href="logout.php" class="logout-link">Logout</a>
                            <?php } else { ?>
                                <a href="cadastro.php" class="cadastro-link">Cadastro</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    </div>
    </div>

    <div class="produto-detalhes">
        
        <div class="img-info">
            <img src="<?php echo htmlspecialchars($produto['img_produto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem do Produto">
        </div>

        <div class="dados-info">
            <h1><?php echo htmlspecialchars($produto['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h1>
            
            <div class="info1">
                <h4>R$ <?php echo htmlspecialchars($produto['preco'], ENT_QUOTES, 'UTF-8'); ?></h4>
                <h4><?php echo htmlspecialchars($produto['categoria'], ENT_QUOTES, 'UTF-8'); ?></h4>
            </div>

            <div class="info1">
                <h4>Tipo: <?php echo htmlspecialchars($produto['tipo'], ENT_QUOTES, 'UTF-8'); ?></h4>
                <h4>Quantidade: <?php echo htmlspecialchars($produto['quantidade'], ENT_QUOTES, 'UTF-8'); ?></h4>
            </div>
                                
            <div class="desc">
                <h4><?php echo htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8'); ?></h4>
            </div>
            
        </div>
        
    </div>
</body>

</html>
