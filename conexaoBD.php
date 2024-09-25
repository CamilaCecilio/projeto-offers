<?php
class Conexao {
    private $host = 'localhost';
    private $dbname = 'bdoffersfast';
    private $username = 'root';
    private $password = '';
    public $conn; // Variável pública para a conexão

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit();
        }
    }

    public function getConnection() {
        return $this->conn; // Método para retornar a conexão
    }
}
?>

