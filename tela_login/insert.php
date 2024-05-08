<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inserir Dados</title>
</head>

<body>
    <div class="container">
        <div class="border p-3">
            <?php
            
             include "./conexaoBD.php";

            //Inserindo dados no banco
            if (isset($_POST['submit'])) {
                if (empty($_POST['nome'] || empty($_POST['email']  ||  empty($_POST['senha'] )))) {
                    echo "<div class='alert alert-danger' role='alert'>Preencha os campos! </div>";
                } else {
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    if (strlen($senha) > 6 || strlen($senha) < 6) {
                        echo "<div class='alert alert-danger' role='alert'>A senha deve ter 6 caracteres!</div>";
                    } else {
                        $sql = "INSERT INTO usuario VALUES(NULL, '$nome','$email','$senha')";


                    try {
                        $conn->query($sql);
                        echo "<div class='alert alert-success'role='success'>Dados inseridos com sucesso!</div>";
                        
                    } catch (Exception $e) {
                        echo "<div class='alert alert-danger'role='alert'>Erro ao inserir: " . $e->getMessage() . "</div>";
                    }
                }}
            }
            ?>
            <a href="cadastro.php" >Voltar</a>
            <a href="../index.php" >Home</a>
        </div>
    </div>
</body>

</html>