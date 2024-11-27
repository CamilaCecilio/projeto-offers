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


    // modificar nome
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
    xhr.open("POST", "actions/salvar_nome.php", true);
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



 // modificar senha
document.getElementById('senha').classList.add('password-hidden');

document.getElementById('cadastro-button').addEventListener('click', function () {
    var dadosConta = document.getElementById('dados-conta');
    if (dadosConta.style.display === 'none') {
        dadosConta.style.display = 'block';
    } else {
        dadosConta.style.display = 'none';
    }
});

// modificar email

function mostrarEdicaoEmail() {
    document.getElementById('email-usuario').style.display = 'none';
    document.getElementById('editar-email').style.display = 'none';
    document.getElementById('input-email').style.display = 'inline';
    document.getElementById('salvar-email').style.display = 'inline';
}

function salvarEmail() {
var novoEmail = document.getElementById('input-email').value;

// Verifique se o novo email não está vazio
if (!novoEmail) {
alert('O email não pode estar vazio.');
return;
}

// Exemplo de chamada AJAX usando fetch
fetch('actions/Alteraremail.php', {
method: 'POST',
headers: {
    'Content-Type': 'application/json'
},
body: JSON.stringify({ email: novoEmail })
})
.then(response => response.json())
.then(data => {
if (data.success) {
    // Se a atualização foi bem-sucedida, atualize a exibição
    document.getElementById('email-usuario').innerText = novoEmail;
    document.getElementById('input-email').style.display = 'none';
    document.getElementById('salvar-email').style.display = 'none';
    document.getElementById('email-usuario').style.display = 'inline';
    document.getElementById('editar-email').style.display = 'inline';
} else {
    alert('Erro ao salvar o email: ' + data.message);
}
})
.catch(error => {
console.error('Erro ao enviar a requisição:', error);
});
}