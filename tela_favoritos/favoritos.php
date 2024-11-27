<?php

try {
  // Database connection credentials (replace with your actual credentials)
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'bdOffersFast';

  // Establish database connection using PDO
  $conexao = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL query to select all products
  $select = $conexao->prepare("SELECT * FROM produto WHERE favorito = 1");

  // Execute the prepared statement
  $select->execute();

  // Fetch all results as an associative array
  $produtos = $select->fetchAll(PDO::FETCH_ASSOC);

  // Close the database connection
  $conexao = null;
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- AOS ANIMATION -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="favoritos.css">
  <title>Ofertas Favoritas</title>
</head>

<body>
  <div data-aos="fade-down">
    <header>
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
    </header>
  </div>
  <div data-aos="zoom-in-up">
    <section id="sec-fav">
      <h1>FAVORITOS</h1>
      <div class="container container-fav">
        <?php
        if ($produtos) {
          foreach ($produtos as $produto) {
        ?>
            <div id="fav-items<?php echo $produto['id_Produto'];?>">
              <form method="GET">
                <div style="display: none;"><?php echo $produto['id_Produto']; ?></div>
                <div><strong>Nome:</strong> <?php echo $produto['nome_produto']; ?></div>
                <div><strong>Preço:</strong> <?php echo $produto['preco']; ?></div>
                <div><strong>Tipo:</strong> <?php echo $produto['tipo']; ?></div>
                <div><strong>Quantidade:</strong> <?php echo $produto['quantidade']; ?></div>
                <div><strong>Categoria:</strong> <?php echo $produto['categoria']; ?></div>
                <div><strong>Descrição:</strong> <?php echo $produto['descricao']; ?></div>
                <button class="bin-button" id="active-modal" onclick="openProductModal(event)" data-id="<?php echo $produto['id_Produto']; ?>">
                  <svg class="bin-top" viewBox="0 0 39 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line y1="5" x2="39" y2="5" stroke="white" stroke-width="4"></line>
                    <line x1="12" y1="1.5" x2="26.0357" y2="1.5" stroke="white" stroke-width="3"></line>
                  </svg>
                  <svg class="bin-bottom" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_8_19" fill="white">
                      <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"></path>
                    </mask>
                    <path d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z" fill="white" mask="url(#path-1-inside-1_8_19)"></path>
                    <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                    <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                  </svg>
                </button>
              </form>
            </div>
        <?php
          }
        } else {
          echo "No products found.";
        }
        ?>
      </div>
      <div class="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">DELETE</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose()"></button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo excluir este produto?.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose()">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="deletar(<?php echo $produto['id_Produto']; ?>)">Deletar</button>
            </div>
          </div>
        </div>
      </div </div>
    </section>
  </div>
  <!-- AOS ANIMATION -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../js/favorito.js"></script>
</body>

</html>