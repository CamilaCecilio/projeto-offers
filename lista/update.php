
<?php 
if(isset($_POST['submit'])){
    $id = $_POST['id_produtolista'];
    $produto = trim($_POST['nome_produtolista']);
    $tipo = $_POST['tipo_produtolista'];
    $quantidade = $_POST['quantidade_produtolista'];
    $mensagem = "";
   
    try {
        //Abrir conexao com banco
        $pdo = new PDO('mysql:host=localhost;dbname=bdoffersfast','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //Preparação da Query
        $sql = "UPDATE produtolista SET nome_produtolista = :nome_produtolista, tipo_produtolista = :tipo_produtolista, quantidade_produtolista = :quantidade_produtolista
        WHERE id_produtolista = :id_produtolista";
        //Comando para preparar a query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_produtolista', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome_produtolista', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_produtolista', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':quantidade_produtolista', $quantidade, PDO::PARAM_STR);
        $stmt->execute();
        //Executar a query
        $mensagem = "Dados atualizados com sucesso!";
    } catch (PDOException $e) {
        // Em caso de erro, define a mensagem de erro
        $mensagem = "Erro ao atualizar os dados: " . $e->getMessage();
    }
    
    // Redireciona de volta para a página index.php com a mensagem
    header("Location: lista.php?mensagem=".urlencode($mensagem));
    exit(); // Termina o script para evitar qualquer saída adicional que possa causar problemas de redirecionamento
} else {
    // Se o formulário de atualização não foi enviado, redireciona para a página inicial com uma mensagem de erro
    header("Location: lista.php?mensagem=".urlencode("Formulário de atualização não enviado."));
    exit();
}
?>