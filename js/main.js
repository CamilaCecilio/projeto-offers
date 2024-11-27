
$(".con-like input").click(function () {
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");

    // Atualiza o status localmente antes de enviar a requisição
    if (status == 0) {
        $(this).attr("data-status", "1");
    } else {
        $(this).attr("data-status", "0");
    }

    // Faz a requisição AJAX
    $.ajax({
        method: "GET",
        url: "actions/set_favorite.php",
        data: { produtoID: id, fav_status: $(this).attr("data-status") }, // Usa o novo status
        success: function (result) {
            // Exibe a mensagem com base na resposta do servidor
            var msg;
            if (result.trim() === "favon") { // Verifica se o resultado é "favon"
                msg = "Produto favoritado com sucesso.";
            } else if (result.trim() === "favoff") { // Verifica se o resultado é "favoff"
                msg = "Produto desfavoritado com sucesso.";
            } else {
                msg = "Erro inesperado."; // Mensagem padrão para outros casos
            }
            alert(msg);
        },
        error: function () {
            alert("Erro ao processar a solicitação."); // Mensagem de erro genérica
        }
    });
});


const element = document.getElementsByClassName('like'); // Assuming the element has ID 'myElement'
var statusfav = element.dataset.status;


if (statusfav == 1) {
    element.classList.add('red-heart')
}

function mostrarsenha() {
    var inputPass = document.getElementById('senhaa');
    var btnShowPass = document.getElementById('btn-senha');

    if (inputPass.type === 'password') {
        inputPass.setAttribute('type', 'text');
        btnShowPass.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
    } else {
        inputPass.setAttribute('type', 'password');
        btnShowPass.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
    }
}


// Função para detectar o pressionamento da tecla Enter
function checkEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault();  // Impede que a página recarregue
        document.forms[0].submit();  // Envia o formulário manualmente
    }
}