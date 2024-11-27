<?php
// Inclui a classe de conexão
include "conexaoBD.php";
session_start();

// Cria uma instância da classe Conexao
$conexao = new Conexao();
$pdo = $conexao->getConnection(); // Obtém a conexão PDO

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['nome'])) {
    $nomeUsuario = '<a>' . $_SESSION['nome'] . '</a>'; // Insere o nome do usuário dentro da tag <a>
    $mostrarLogout = true; // Define como verdadeiro para mostrar o dropdown de logout
    $mostrarperfil = true;
} else {
    $nomeUsuario = '<a href="login.php">Login</a>'; // Define um link de login como padrão se o usuário não estiver logado
    $mostrarLogout = false; // Define como falso para não mostrar o dropdown de logout
}


$id_usuario = $_SESSION['id_usuario'];

try {
    // Consulta SQL para selecionar o usuário
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql); // Prepara a consulta

    // Liga o parâmetro do ID do usuário
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    // Executa a consulta
    $stmt->execute();

    // Busca os dados do usuário
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        $foto_perfil = $user_data['foto_perfil']; // Obtém o caminho da foto de perfil
    } else {
        // Opcional: tratar caso o usuário não seja encontrado
        echo "Usuário não encontrado.";
        exit();
    }
} catch (PDOException $e) {
    // Opcional: tratar erro de consulta
    echo "Erro ao buscar dados do usuário: " . $e->getMessage();
    exit();
}
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
                <h6 href="" class="dropdown">Produtos 
                    <ul class="dropdown-menu ">
                        <a href="cadastroProduto.php">
                            <li class="add-link">Adicionar Oferta</li>
                        </a>
                    </ul>
                </h6>
            </div>
        </div>
            
        <form method="POST" action="actions/search.php" class="edit-input">
            <input class="input-pesquisa" name="search" type="text" placeholder="Pesquisar Produto" onkeypress="checkEnter(event)">
            <!-- O botão não precisa ser visível, o Enter funcionará automaticamente -->
            <button type="submit" style="display: none;"></button>
        </form>

        
        <div id="icons">
            <a href="favoritos.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff"
                        d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                </svg>
            </a>

            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff"
                    d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
            </svg>

            <a href="lista.php" class="lista-icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M280 64h40c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128C0 92.7 28.7 64 64 64h40 9.6C121 27.5 153.3 0 192 0s71 27.5 78.4 64H280zM64 112c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320c8.8 0 16-7.2 16-16V128c0-8.8-7.2-16-16-16H304v24c0 13.3-10.7 24-24 24H192 104c-13.3 0-24-10.7-24-24V112H64zm128-8a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                </svg>
            </a>

            <a href="login.php">
            <div id="login" class="dropdown-login">
                <svg xmlns="http://www.w3.org/2000/svg" height="0.9em" viewBox="0 0 448 512" class="login-icon">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff"
                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                </svg>
                
                <ul class= "position-login">
                    <li class="edit">
                        <?php echo $nomeUsuario; ?>
                        <div class="dropdown-menu-login">
                            <?php if ($mostrarLogout) { ?>
                                <a href="actions/logout.php" class="logout-link">Logout</a>
                                <a href="perfil.php">Perfil</a>
                            <?php } else { ?>
                                <a href="cadastro.php" class="cadastro-link">Cadastro</a>
                            <?php } ?>
                        </div>

                    </li>
                </ul>
            </div>
            </a>


        </div>
    </div>
    </div>
    </div>
    <!--fim do menu -->


    <div class="card">
        <ul class="list-group list-group-flush">
            <li>
                <h1>Olá <?php echo $_SESSION['nome']; ?>,<br> aqui é a sua conta :)</h1>
            </li>
            <li class="list-group-item">
                <form action="actions/upload_foto_perfil.php" method="post" enctype="multipart/form-data">
                    <div class="foto-perfil-container">
                        <input type="file" name="foto_perfil" id="file-input" class="file-input">
                        <img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil" class="foto-perfil-img">
                        <div class="foto-perfil-text">
                            <!-- Texto ou ícone opcional -->
                        </div>
                    </div>
                    <div class="form-delete">
                        <button class="action_has has_saved" aria-label="save" type="submit" name="submit">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" fill="none">
    <path d="m19,21H5c-1.1,0-2-.9-2-2V5c0-1.1.9-2,2-2h11l5,5v11c0,1.1-.9,2-2,2Z" stroke-linejoin="round" stroke-linecap="round" data-path="box"></path>
    <path d="M7 3L7 8L15 8" stroke-linejoin="round" stroke-linecap="round" data-path="line-top"></path>
    <path d="M17 20L17 13L7 13L7 20" stroke-linejoin="round" stroke-linecap="round" data-path="line-bottom"></path>
  </svg>
</button>
</div>
                    
                </form>

                <div class="edit-perfil">

                    <!--<button type="submit" name="submit" class="btn btn-primary mt-2">Salvar Foto</button>-->

                        <form action="actions/remover_foto_perfil.php" method="post" class="form-delete">
                            <!--<button type="submit" name="remover_foto" class="btn btn-danger">Remover Foto</button>-->

                            <button name="remover_foto" class="bin-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 39 7" class="bin-top">
                            <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                            <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357" y1="1.5" x1="12"></line>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 39" class="bin-bottom">
                            <mask fill="white" id="path-1-inside-1_8_19">
                            <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"></path>
                            </mask>
                            <path mask="url(#path-1-inside-1_8_19)" fill="white" d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"></path>
                            <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                            <path stroke-width="4" stroke="white" d="M21 6V29"></path>
                        </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 89 80" class="garbage">
                    <path fill="white" d="M20.5 10.5L37.5 15.5L42.5 11.5L51.5 12.5L68.75 0L72 11.5L79.5 12.5H88.5L87 22L68.75 31.5L75.5066 25L86 26L87 35.5L77.5 48L70.5 49.5L80 50L77.5 71.5L63.5 58.5L53.5 68.5L65.5 70.5L45.5 73L35.5 79.5L28 67L16 63L12 51.5L0 48L16 25L22.5 17L20.5 10.5Z"></path>
                    </svg>
</button>

                        </form>
    
                    <!--<button type="button" class="btn-select-file btn btn-primary mt-2" onclick="document.getElementById('file-input').click()">Alterar Foto</button>-->

                </div>
                

                </form>
            </li>
            <li class="list-group-item">
                <h3><a href="#" id="cadastro-button" class="cadastro-link">Dados da conta</a></h3>
            </li>
            <li class="list-group-item" id="dados-conta" style="display: none;">
                <div class="username">
                    <h5>Nome Usuário: </h5>
                    
                </div>

                <?php
                if ($user_data) {

                    echo "<span id='nome-usuario'>" . $user_data['nome'] . "</span>";
                    echo "<a href='#' id='editar-nome' class='toggle-link' onclick='mostrarEdicaoNome()'>Editar nome</a><br>";
                    echo "<input type='text' id='input-nome' class='edit-name' value='" . $user_data["nome"] . "' style='display: none;'>";
                    echo "<button id='salvar-nome' class='edit-name' onclick='salvarNome()' style='display: none;'>Salvar</button>";
                    
                    echo "<h5>Email:</h5>";
                    echo "<span id='email-usuario'>" . htmlspecialchars($user_data["email"]) . "</span>";
                    echo "<a href='#' id='editar-email' class='toggle-link' onclick='mostrarEdicaoEmail()'>Editar email</a><br>";
                    echo "<input type='email' id='input-email' class='edit-email' value='" . htmlspecialchars($user_data["email"]) . "' style='display: none;'>"; // Alterado para type='email'
                    echo "<button id='salvar-email' class='edit-email' onclick='salvarEmail()' style='display: none;'>Salvar</button>"; // Renomeado para salvarEmail                   
                     

                    echo "<h5>Senha:</h5>";
                    echo "<span id='senha' class='password-hidden'>" . $user_data["senha"] . "</span>";
                    echo "<a href='#' id='toggle-senha' class='toggle-link' onclick='toggleSenha()'>Mostrar senha</a><br>";
                    echo "<a href='alterarSenha.php' id='alterar-senha' class='toggle-link'>Alterar senha</a><br>";

                } else {
                    echo "<span>Erro ao buscar dados</span>";
                }
                ?>
            </li>
        </ul>
    </div>
</body>
<script src="js/perfil.js"></script>
</html>