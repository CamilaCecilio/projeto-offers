<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap" rel="stylesheet"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&display=swap" rel="stylesheet"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- FONTE -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,700;1,9..40,700&family=Poppins&display=swap" rel="stylesheet"> <!-- FONTE -->
    <link rel="stylesheet" href="css/mainCadastro.css"> <!-- CSS -->
</head>

<body>
    <div class="part_white">
        <form action="actions/insertProduto.php" method="POST" class="form_login" enctype="multipart/form-data">
            <h1>Cadastre seu Produto</h1>
            <div class="input-label">
                <label for="nome_produto">Nome do Produto</label>
                <input type="text" name="nome_produto" placeholder="Digite o nome do produto">
            </div>
            <div class="item-flex">
                <div class="input-label">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" class="form-select" name="categoria">
                        <option value="Sacolão">Sacolão</option>
                        <option value="Supermercado">Supermercado</option>
                        <option value="Padaria">Padaria</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="input-label">
                    <label for="preco">Preço</label>
                    <input style="width:8rem" type="" name="preco" placeholder="8.90">
                </div>
            </div>
            <div class="item-flex">
                <div class="input-label">
                    <label for="Tipo">Tipo</label>
                    <select class="form-select" name="tipo">
                        <option value="Grama">Grama</option>
                        <option value="Kilo">Kilo</option>
                        <option value="Litro">Litro</option>
                        <option value="Unidade">Unidade</option>
                    </select>
                </div>
                <div class="input-label">
                    <label for="quant">Quantidade</label>
                    <input style="width:8rem" type="" name="quant" placeholder="Exemplo: 250">
                </div>
            </div>
            <div class="input-label">
                <label>Faça o upload de uma imagem:</label>
                <input type="file" name="img_produto">
            </div>
            <div class="input-label">
                <label>Descrição do produto</label>
                <Textarea name="descricao" class="descricao"></Textarea>
            </div>
            <div id="flex_final_form">
                <a href="index.php">
                    <span>Voltar</span>
                </a>
                <a href="index.php">
                    <button id="button_cadastro" type="submit" name="submit"> Cadastrar Produto <img src="assets/icon_button.svg" alt=""></button>
                </a>
            </div>
    </div>
    </form>
    </div>

</body>

</html>
