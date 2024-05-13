<?php
// Conexão com o banco de dados
include "conexaoBD.php";

// Consulta SQL para selecionar todos os produtos
$sql = "SELECT * FROM produto";
$result = $conn->query($sql);

// Definindo o limite de produtos a serem exibidos
$limite = 6;
$contador = 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap" rel="stylesheet"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&display=swap" rel="stylesheet"> <!-- FONTE -->
    <link href="insert.php"> <!-- ARQUIVO INSERT -->
    <link rel="stylesheet" href="style.css"> <!-- CSS -->
    <link rel="stylesheet" href="main.css"> <!-- CSS -->
    <title>Offers</title>
</head>
<body>
    <div id="headid">
        <div id="menu">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
            </svg>
        </div>
        <div id="home">
            <div class="text">
                <h6 href="">Home</h6>
            </div>
            <div class="text">
                <h6 href="">Produtos <ul>
                        <a href="cadastrar_produto/cadastroProduto.php">
                            <li>Adicionar Oferta</li>
                        </a>
                    </ul>
                </h6>
            </div>
            <input class="input" name="text" type="text" placeholder="Pesquisar Produto">
        </div>
        <div id="icons">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff" d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
            </svg>
            <div id="login">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#ffffff" d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                </svg>
                <a href="tela_login\login.php">Login <ul>
                        <a href="">
                            <li>LogOut</li>
                        </a>
                    </ul>
                </a>
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
                <img src="./assets/" alt="" style="width: 20%;">
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
                <form action="tela_favoritos/carrinho.php" method="GET">
                    <div style="display: none;"><?php echo $produto['id_Produto']; ?></div>
                    <div><strong>Nome:</strong> <?php echo $produto['nome_produto']; ?></div>
                    <div><strong>Preço:</strong> <?php echo $produto['preco']; ?></div>
                    <div><strong>Tipo:</strong> <?php echo $produto['tipo']; ?></div>
                    <div><strong>Quantidade:</strong> <?php echo $produto['quantidade']; ?></div>
                    <div><strong>Categoria:</strong> <?php echo $produto['categoria']; ?></div>
                    <div><strong>Descrição:</strong> <?php echo $produto['descricao']; ?></div>
                    <div class="con-like">
                        <input id="btn-<?php echo $produto['id_Produto']; ?>" data-id="<?php echo $produto['id_Produto']; ?>" data-status="<?php echo $produto['favorito']; ?>" class="like" type="checkbox" title="like">
                        <div class="checkmark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                                <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
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
                    <br />
                </form>
            </div>
        <?php
            // Incrementa o contador
            $contador++;
        }
        $conn->close();
        ?>
    </section>
    <section class="sobre_nos">
    </section>
    <footer>
        <div class="container">
            <img src="assets/logooffers.png" alt="">
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(".con-like input").click( function() {
            var id = $(this).attr("data-id");
            var status = $(this).attr("data-status");
            if (status == 0){
                $(this).attr("data-status", "1");
            }
            else {
                $(this).attr("data-status", "0");
            }
            $.ajax({
                method: "GET",
                url: "actions/set_favorite.php",
                data: {produtoID: id, fav_status: status},
                success: function(result){
                    if (result=="favon"){
                        var msg = "Produto favoritado com sucesso.";
                    }
                    else {
                        var msg = "Produto desfavoritado com sucesso.";
                    }
                    alert(msg)
                },
                error: function(result) {}
            });
        });
    </script>
</body>
</html>