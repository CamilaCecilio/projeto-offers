<?php
// Incluir o arquivo de conexão com o banco de dados
include "conexaoBD.php";

// Criar uma instância da classe Conexao
$conexao = new Conexao();
$conn = $conexao->conn; // Acessar a conexão PDO

// Consulta SQL para selecionar todos os produtos
$sql = "SELECT * FROM produto";
$result = $conn->query($sql); // Executar a query

// Definindo o limite de produtos a serem exibidos
$limite = 6;
$contador = 0;

session_start(); // Inicia a sessão (se já não estiver iniciada)

if (isset($_SESSION['nome'])) {
    $nomeUsuario = '<a>' . $_SESSION['nome'] . '</a>'; // Insere o nome do usuário dentro da tag <a>
    $mostrarLogout = true; // Define como verdadeiro para mostrar o dropdown de logout
    $mostrarperfil = true;
} else {
    $nomeUsuario = '<a href="login.php">Login</a>'; // Define um link de login como padrão se o usuário não estiver logado
    $mostrarLogout = false; // Define como falso para não mostrar o dropdown de logout
}

                    //RAPAZIADA A GENTE PRECISA MUDAR ISSO AQ Q TA FEI DMS  ass: emo
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
    <link rel="stylesheet" href="css/main.css"> <!-- CSS -->
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
                <h6 href="" class="dropdown">Produtos <ul class="dropdown-menu">
                        <a href="cadastroProduto.php">
                            <li class="add-link">Adicionar Oferta</li>
                        </a>
                    </ul>
                </h6>
            </div>
            <form method="POST" action="actions/search.php">
        <input class="input" name="search" type="text" placeholder="Pesquisar Produto" onkeypress="checkEnter(event)">
        <!-- O botão não precisa ser visível, o Enter funcionará automaticamente -->
        <button type="submit" style="display: none;"></button>
    </form>
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
            <a href="lista/lista.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M280 64h40c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128C0 92.7 28.7 64 64 64h40 9.6C121 27.5 153.3 0 192 0s71 27.5 78.4 64H280zM64 112c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320c8.8 0 16-7.2 16-16V128c0-8.8-7.2-16-16-16H304v24c0 13.3-10.7 24-24 24H192 104c-13.3 0-24-10.7-24-24V112H64zm128-8a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                </svg> </a>

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
                                <a href="perfil.php">Perfil</a>
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
    <section class="title_home">
        <div class="slogan">
            <h1>Grandes <span>ofertas</span>,</br>
                em um só lugar!</h1>
            <p>Descubra descontos incríveis em um só lugar. Junte-se à nossa comunidade e economize mais!</p>
        </div>
        <div>
            <div class="box_images1">
                <img src="./assets/sacolas-de-compras.png" alt="" style="width: 10%;">
                <p>Sacolão</p>
            </div>

            <div class="imagens_home1">
                <img src="./assets/Imagem1.png" alt="">
            </div>

            <div class="box_images2">
                <img src="./assets/estrela.svg" alt="" style="width: 20%;">
                <p>4.8</p>
            </div>

            <div class="imagens_home2">

                <img src="./assets/Imagem1.png" alt="">
            </div>

            <div class="box_images3">
                <img src="./assets/estrela.svg" alt="" style="width: 20%;">
                <p>4.8</p>
            </div>
        </div>
    </section>
    <section class="categorias_menu">
        <div class="item_seta esquerda">
            <img src="./assets/seta-esquerda.svg" alt="">
        </div>
        <div class="container container-border">
            <div class="item_categoria">
                <img src="" alt="">
                <button>
                    <span class="button_top">
                        Alimentos
                    </span>
                </button>
            </div>
            <div class="item_categoria">
                <img src="" alt="">
                <button>
                    <span class="button_top">
                        Frutas
                    </span>
                </button>
            </div>
            <div class="item_categoria">
                <img src="" alt="">
                <button>
                    <span class="button_top">
                        Legumes
                    </span>
                </button>
            </div>
            <div class="item_categoria">
                <img src="" alt="">
                <button>
                    <span class="button_top">
                        Limpeza
                    </span>
                </button>
            </div>
        </div>
        <div class="item_seta">
            <img src="./assets/seta-direita.svg" alt="">
        </div>
    </section>
    <section class="ofertas">
        <?php

        // Loop através dos produtos usando foreach
        foreach ($result as $produto) {
            // Verifica se o contador atingiu o limite
            if ($contador >= $limite) {
                break;
            }
            ?>
            <div class="produto">

                <form method="GET">

                    <a href="infoProduto.php?id=<?= $produto['id_produto'] ?>">

                        <div class="img_produto"><img
                                src="<?php echo htmlspecialchars($produto['img_produto'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="Imagem do Produto"></div>
                        <div style="display: none;"><?php echo $produto['id_produto']; ?></div>
                        <div class="info_produto">
                            <div class="nome_produto"> <?php echo $produto['nome_produto']; ?></div>
                            <div><span>R$</span> <?php echo $produto['preco']; ?></div>
                        </div>


                        <div class="flex_produto">
                            <div class="tipo_produto"> <span><?php echo $produto['categoria']; ?></span></div>
                            <div class="con-like">

                                <input id="btn-<?php echo $produto['id_produto']; ?>"
                                    data-id="<?php echo $produto['id_produto']; ?>"
                                    data-status="<?php echo $produto['favorito']; ?>" class="like" type="checkbox"
                                    title="like" <?php if ($produto['favorito'] == 1) {
                                        echo "checked";
                                    } ?>>
                                <div class="checkmark">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                                        <polygon class="poly" points="10,10 20,20"></polygon>
                                        <polygon class="poly" points="10,50 20,50"></polygon>
                                        <polygon class="poly" points="20,80 30,70"></polygon>
                                        <polygon class="poly" points="90,10 80,20"></polygon>
                                        <polygon class="poly" points="90,50 80,50"></polygon>
                                        <polygon class="poly" points="80,80 70,70"></polygon>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <br />

                    </a>
                </form>

            </div>
            <?php
            // Incrementa o contador
            $contador++;
        }
        $conn = null;
        ?>
    </section>
    <!--About-->
    <section class="sobre_nos">

        <div class="rectangle">
            <div class="half-circle">
                <h1>Sobre-nós</h1>
            </div>
        </div>

        <div class="about">

        </div>

    </section>

    <!--Avaliação-->
    <div class="container-avaliacao">
        <div class="div-text">
            <h1>Avaliações</h1>
        </div>

        <div class="avaliacao">

            <div class="comentario"></div>
            <div class="comentario"></div>

        </div>

    </div>



    <!--Contato-->
    <div class="container-contact">

        <div class="text-contact">

            <h1>Entre em contato<br>com a gente!</h1>
            <h4>Entre em contato com a <span>OffersFast</span>,<br>
                queremos tirar suas dúvidas, ouvir suas<br>
                críticas e sugestões.</h4>

            <button>Fale Conosco!</button>

        </div>
        <div class="contact">
            <div class="head-contact">
                <div class="left">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.8em"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#000000"
                            d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                    </svg>
                    <h4>OffersFast</h4>
                </div>
                <div class="right">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#000000"
                            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                    </svg>
                </div>
            </div>
            <div class="body-contact">
                <div class="message1">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1.8em"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#000000"
                                d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                        </svg>
                    </div>
                    <div class="edit-message">
                        <h4>Você tem alguma dúvida?</h4>
                    </div>
                </div>

                <div class="message2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1.8em"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#000000"
                                d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                        </svg>
                    </div>
                    <div class="edit-message">
                        <h4>Entre em contato!</h4>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <footer>
        <div class="container1">
            <div class="offers">
                <img src="./assets/logooffers.png" alt="">
                <h1>OffersFast</h1>
            </div>

            <div class="container2">
                <a href="#" class="back-to-top">
                    <div class="circle-footer">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                        </svg>
                    </div>
                </a>
            </div>

        </div>



        <div class="container3">
            <div class="btn-footer">
                <button>Home</button>
                <button>Produtos</button>
                <button>Contato</button>
            </div>

            <div class="container4">
                <h4>© Copyright 2024, All Rights Reserved</h4>
            </div>

        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/main.js">
    </script>
</body>