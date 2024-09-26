<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inserir Dados</title>
</head>

<body>
    <div class="container">
        <div class="border p-3">
            <?php
            include "../conexaoBD.php";

            // Inserindo dados no banco
            if (isset($_POST['submit'])) {
                // Verificação dos campos obrigatórios
                if (empty($_POST['nome_produto']) || empty($_POST['categoria']) || empty($_POST['preco']) || empty($_POST['descricao']) || empty($_POST['tipo']) || empty($_POST['quant']) || empty($_FILES['img_produto']['name'])) {
                    echo "<div class='alert alert-danger' role='alert'>Preencha todos os campos!</div>";
                } else {
                    $nome_produto = $_POST['nome_produto'];
                    $categoria = $_POST['categoria'];
                    $preco = $_POST['preco'];
                    $tipo = $_POST['tipo'];
                    $quant = $_POST['quant'];
                    $descricao = $_POST['descricao'];

                    $img_nome = $_FILES["img_produto"]["name"];
                    $img_destino = "../uploads_img/" . $img_nome;
                    $img_destino_novo = str_replace("../", "", $img_destino);

                    if (!file_exists('../uploads_img')) {
                        mkdir('../uploads_img', 0777, true);
                    }

                    if (move_uploaded_file($_FILES["img_produto"]["tmp_name"], $img_destino)) {
                        /* INSERT */
                        $sql = "INSERT INTO produto (nome_produto, categoria, preco, tipo, quantidade, descricao, img_produto) VALUES (:nome_produto, :categoria, :preco, :tipo, :quantidade, :descricao, :img_produto)";
                        
                        try {
                            // Obtendo a conexão PDO
                            $conexao = new Conexao();
                            $pdo = $conexao->getConnection();

                            // Preparando a consulta
                            $stmt = $pdo->prepare($sql);
                            // Bind dos parâmetros
                            $stmt->bindParam(':nome_produto', $nome_produto);
                            $stmt->bindParam(':categoria', $categoria);
                            $stmt->bindParam(':preco', $preco);
                            $stmt->bindParam(':tipo', $tipo);
                            $stmt->bindParam(':quantidade', $quant);
                            $stmt->bindParam(':descricao', $descricao);
                            $stmt->bindParam(':img_produto', $img_destino_novo);

                            // Executando a consulta
                            $stmt->execute();
                            echo "<div class='alert alert-success' role='success'>Dados inseridos com sucesso!</div>";
                        } catch (Exception $e) {
                            echo "<div class='alert alert-danger' role='alert'>Erro ao inserir: " . $e->getMessage() . "</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Erro ao mover o arquivo para o destino!</div>";
                    }
                }
            }
            ?>
            <a href="../cadastroProduto.php">Voltar</a>
            <a href="../index.php">Home</a>
        </div>
    </div>
</body>


</html>