<?php
// Verifica se o ID do produto foi enviado via GET
if (isset($_GET['id_produtolista'])) {
    // Obtém o ID do produto da URL
    $id = $_GET['id_produtolista'];

    // Conecta ao banco de dados
    $pdo = new PDO('mysql:host=localhost;dbname=bdoffersfast', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura para lançar exceções em caso de erro

    // Prepara e executa a query para selecionar o produto pelo ID
    $sql = "SELECT * FROM produtolista WHERE id_produtolista = :id_produtolista";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_produtolista', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Obtém os dados do produto
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o produto foi encontrado
    if ($produto) {
?>

        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/lista.css">
            <title>Editar Produto</title>
        </head>

        <body>
            <h1 class="text-center">Editar Produto</h1>
            <div class="container col-md-6">
                <div class="container3">
                    <div class="border p-4 rounded mb-4">

                        <form action="update_lista.php" method="post">
                            <input type="hidden" name="id_produtolista" value="<?php echo $produto['id_produtolista']; ?>">

                            <div class="container2 text-center">
                                <div class="row">
                                    <div class="col">
                                    <input type="text" name="nome_produtolista" class="form-control" id="exampleInputNome" placeholder="Adicione um produto" value="<?php echo $produto['nome_produtolista']; ?>">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="quantidade_produtolista" class="form-control" id="inputQuantidade" placeholder="Quantidade" min="0" value="<?php echo $produto['quantidade_produtolista']; ?>">
                                    </div>
                                    <div class="col">
                                        <select id="unitSelector" name="tipo_produtolista" class="form-select">
                                            <option value="KG" <?php echo ($produto['tipo_produtolista'] == 'KG') ? 'selected' : ''; ?>>KG</option>
                                            <option value="Unidade" <?php echo ($produto['tipo_produtolista'] == 'Unidade') ? 'selected' : ''; ?>>Unidade</option>
                                            <option value="G" <?php echo ($produto['tipo_produtolista'] == 'G') ? 'selected' : ''; ?>>G</option>
                                        </select>    
                                    </div>
                                </div>
                            </div>
                            <br>  
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" name="submit" value="Atualizar">
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        // Se o produto não for encontrado, redireciona para a página inicial com uma mensagem de erro
        header("Location: ../lista.php?mensagem=" . urlencode("Produto não encontrado."));
        exit();
    }
} else {
    // Se o ID do produto não foi enviado via GET, redireciona para a página inicial com uma mensagem de erro
    header("Location: ../lista.php?mensagem=" . urlencode("ID do produto não especificado."));
    exit();
}
?>