<?php
// Inclui a classe de conexão
include "../conexaoBD.php";
session_start();

// Cria uma instância da classe Conexao
$conexao = new Conexao();

// Obtém a conexão PDO
$conn = $conexao->getConnection();

if (isset($_POST['nome']) && isset($_SESSION['id_usuario'])) {
    $novo_nome = trim($_POST['nome']);
    
    // Verifica se o novo nome não está vazio
    if (empty($novo_nome)) {
        echo "O nome não pode estar vazio.";
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];

    // Prepara a consulta
    $sql = "UPDATE usuario SET nome = :nome WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);

    // Vincula os parâmetros de forma segura
    $stmt->bindParam(':nome', $novo_nome, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    // Executa a consulta e verifica o resultado
    if ($stmt->execute()) {
        $_SESSION['nome'] = $novo_nome; // Atualiza o nome na sessão
        echo "Nome atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o nome.";
    }

    // Não é necessário fechar o statement ou a conexão explicitamente aqui, 
    // mas se quiser, pode implementar um método de fechamento na classe Conexao.

} else {
    echo "Dados inválidos.";
}
?>

