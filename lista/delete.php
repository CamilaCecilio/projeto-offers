<?php 
if(isset($_GET['id_produtolista'])){
    $id = $_GET['id_produtolista'];
    $resposta;
    try {
        //Abrir conexao com banco
        $pdo = new PDO('mysql:host=localhost;dbname=bdoffersfast','root','');
    
        //Preparação da Query
        $sql = "DELETE FROM produtolista WHERE id_produtolista = :id_produtolista";
        //Comando para preparar a query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_produtolista', $id, PDO::PARAM_INT);
        //Executar a query
        $resposta = $stmt->execute();
    } catch (PDOException $e) {
        $resposta = $e->getMessage();
    }
    
    header("Location: lista.php?resposta=".$resposta);
}
?>
