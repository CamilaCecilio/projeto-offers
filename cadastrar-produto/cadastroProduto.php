<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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


    <link rel="stylesheet" href="styleCadastro.css">

</head>

<body>

    <div class="part_white">

        <form action="insertProduto.php" method="post" class="form_login">

            <h1>Cadastre seu Produto</h1>

            <div class="input-label">
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome_produto" placeholder="Digite o nome do produto">
            </div>

            <div class="item-flex">
            <div class="input-label">
                <label for="categoria">Categoria</label>
                <select id="categoria" style="width: 36vh; " class="form-select" name="categoria">
                    <option value="Sacolão">Sacolão</option>
                    <option value="Supermercado">Supermercado</option>
                    <option value="Padaria">Padaria</option>
                    <option value="Outro">Outro</option>

                </select>
            </div>

            <div class="input-label">
                <label for="preco">Preço</label>
                <input style="width:8rem"type="" name="preco" placeholder="8.90">
            </div>

        </div>
           

            <div class="input-label">
            <label>Descrição do produto</label>
            <Textarea name="descricao" class="descricao"></Textarea>
            </div>
          

                <a href="index.php">

                    <button id="button_cadastro" type="submit" name="submit"> Cadastrar Produto <img src="./assets_login/seta-svg/ant-design_swap-left-outlined.svg" alt=""></button>
                  
                </a>
            </div>
        </form>
    </div>

</body>

</html>