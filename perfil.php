<?php
include "conexaoBD.php";
session_start();

$conexao = new Conexao();
$pdo = $conexao->getConnection(); // Obtém a conexão PDO

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
}

$id_usuario = $_SESSION['id_usuario'];

try {
    // Consulta SQL para selecionar o usuário
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql); // Prepara a consulta
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT); // Liga o parâmetro do ID do usuário
    $stmt->execute(); // Executa a consulta

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC); // Busca os dados do usuário

    if ($user_data) {
        $foto_perfil = $user_data['foto_perfil']; // Obtém o caminho da foto de perfil
    } else {
        // Opcional: tratar caso o usuário não seja encontrado
        echo "Usuário não encontrado.";
        exit();
    }
} catch (PDOException $e) {
    // Opcional: tratar erro de consulta
    echo "Erro ao buscar dados do usuário: " . $e->getMessage();
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@0,9..40;1,9..40&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Offers</title>
</head>

<body>
    <div class="card" style="width: 18rem; text-align: center;">
        <ul class="list-group list-group-flush">
            <li>
                <h1><?php echo $_SESSION['nome']; ?>! Olá, aqui é a sua conta :)</h1>
            </li>
            <li class="list-group-item">
                <form action="actions/upload_foto_perfil.php" method="post" enctype="multipart/form-data">
                    <div class="foto-perfil-container">
                        <input type="file" name="foto_perfil" id="file-input" class="file-input">
                        <img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil" class="foto-perfil-img">
                        <div class="foto-perfil-text">
                            <!-- Texto ou ícone opcional -->
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-2">Salvar Foto</button>
                </form>

                <form action="actions/remover_foto_perfil.php" method="post">
                    <button type="submit" name="remover_foto" class="btn btn-danger">Remover Foto</button>
                </form>

                <button type="button" class="btn-select-file btn btn-primary mt-2" onclick="document.getElementById('file-input').click()">Alterar Foto</button>

                </form>
            </li>
            <li class="list-group-item">
                <h3><a href="#" id="cadastro-button" class="cadastro-link">Cadastro</a></h3>
            </li>
            <li class="list-group-item" id="dados-conta" style="display: none;">
                <h3>Dados da conta</h3>
                <?php
                if ($user_data) {
                    echo "<h5>Email:</h5>";
                    echo "<span>" . $user_data["email"] . "</span><br>";
                    echo "<h5>Senha:</h5>";
                    echo "<span id='senha' class='password-hidden'>" . $user_data["senha"] . "</span>";
                    echo "<a href='#' id='toggle-senha' class='toggle-link' onclick='toggleSenha()'>Mostrar senha</a><br>";
                    echo "<a href='alterarSenha.php' id='alterar-senha' class='toggle-link'>Alterar senha</a><br>";
                    echo "<h5>Nome de usuario:</h5>";
                    echo "<span id='nome-usuario'>" . $user_data["nome"] . "</span>";
                    echo "<a href='#' id='editar-nome' class='toggle-link' onclick='mostrarEdicaoNome()'>Editar nome</a><br>";
                    echo "<input type='text' id='input-nome' class='edit-name' value='" . $user_data["nome"] . "' style='display: none;'>";
                    echo "<button id='salvar-nome' class='edit-name' onclick='salvarNome()' style='display: none;'>Salvar</button>";
                } else {
                    echo "<span>Erro ao buscar dados</span>";
                }
                ?>
            </li>
        </ul>
    </div>
    <script>
        function toggleSenha() {
            var senhaElement = document.getElementById('senha');
            var toggleLink = document.getElementById('toggle-senha');
            if (senhaElement.classList.contains('password-hidden')) {
                senhaElement.classList.remove('password-hidden');
                toggleLink.innerText = 'Ocultar senha';
                senhaElement.style.pointerEvents = 'auto'; // Permite a cópia do texto
                senhaElement.style.userSelect = 'auto'; // Permite a seleção do texto
            } else {
                senhaElement.classList.add('password-hidden');
                toggleLink.innerText = 'Mostrar senha';
                senhaElement.style.pointerEvents = 'none'; // Impede a cópia do texto
                senhaElement.style.userSelect = 'none'; // Impede a seleção do texto
            }
        }

        function mostrarEdicaoNome() {
            document.getElementById('nome-usuario').style.display = 'none';
            document.getElementById('editar-nome').style.display = 'none';
            document.getElementById('input-nome').style.display = 'inline';
            document.getElementById('salvar-nome').style.display = 'inline';
        }

        function salvarNome() {
            var novoNome = document.getElementById('input-nome').value;
            if (novoNome.trim() === "") {
                alert("O nome não pode estar vazio.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "salvar_nome.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('nome-usuario').innerText = novoNome;
                    document.getElementById('nome-usuario').style.display = 'inline';
                    document.getElementById('editar-nome').style.display = 'inline';
                    document.getElementById('input-nome').style.display = 'none';
                    document.getElementById('salvar-nome').style.display = 'none';
                }
            };
            xhr.send("nome=" + encodeURIComponent(novoNome));
        }

        document.getElementById('senha').classList.add('password-hidden');

        document.getElementById('cadastro-button').addEventListener('click', function () {
            var dadosConta = document.getElementById('dados-conta');
            if (dadosConta.style.display === 'none') {
                dadosConta.style.display = 'block';
            } else {
                dadosConta.style.display = 'none';
            }
        });
    </script>
</body>

</html>