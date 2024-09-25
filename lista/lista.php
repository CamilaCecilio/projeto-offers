<?php
// Conectar ao banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=bdoffersfast', 'root', '');
$sql = "SELECT * FROM produtolista";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$linhas = $stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="lista.css">
    <title>Cadastro de Produto</title>
</head>

<body>

    <h1 class="text-center">Adicione seus produtos</h1>
    <div class="container col-md-6">
        <div class="container3">
            <div class="border p-4 rounded mb-4">

                <form action="insert.php" method="post">
                    <div class="container2 text-center">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nome_produtolista" class="form-control" id="exampleInputNome" placeholder="Adicione um produto">
                            </div>
                            <div class="col">
                                <select id="unitSelector" name="tipo_produtolista" class="form-select">
                                    <option value="kG">KG</option>
                                    <option value="Unidade">Unidade</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" name="quantidade_produtolista" class="form-control" id="inputQuantidade" placeholder="Quantidade" min="0">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5V7h2.5a.5.5 0 0 1 0 1H8.5v2.5a.5.5 0 0 1-1 0V8H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z" />
                            </svg>
                        </button>
                    </div>
                </form>
                
            </div>
        </div>

        <div class="container2">
            <table class="table table-striped table-bordered mt-4">
                <tbody>
                    <?php if ($linhas > 0) : ?>
                        <?php foreach ($resultado as $r) : ?>
                            <tr>
                                <td><?= $r['nome_produtolista'] ?> - <?= $r['quantidade_produtolista'] ?> <?= $r['tipo_produtolista'] ?></td>
                                <td>
                                    <a href="update_process.php?id_produtolista=<?php echo $r['id_produtolista']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="delete.php?id_produtolista=<?= $r['id_produtolista'] ?>" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">Não há dados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="lista.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+xnm1pD4sVEkH5pvVkEBeR/yssy7j+1kmO67PL1r1jFn7bJbcXsrITrBkcoF/8" crossorigin="anonymous"></script>
</body>

</html>