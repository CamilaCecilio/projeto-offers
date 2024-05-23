
$(".con-like input").click( function() {
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    if (status == 0){
        $(this).attr("data-status", "1");
    }
    else {
        $(this).attr("data-status", "0");
    }
    $.ajax({
        method: "GET",
        url: "actions/set_favorite.php",
        data: {produtoID: id, fav_status: status},
        success: function(result){
            if (result=="favon"){
                var msg = "Produto favoritado com sucesso.";
            }
            else {
                var msg = "Produto desfavoritado com sucesso.";
            }
            alert(msg)
        },
        error: function(result) {}
    });
});

const element = document.getElementsByClassName('like'); // Assuming the element has ID 'myElement'
var statusfav = element.dataset.status;


if(statusfav == 1) {
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


/* SCROLL ANIM */

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.querySelector('.back-to-top').style.display = "block";
    } else {
        document.querySelector('.back-to-top').style.display = "none";
    }
}

document.querySelector('.back-to-top').addEventListener('click', function(e) {
e.preventDefault();
document.body.scrollTop = 0; /* Para navegadores Safari */
document.documentElement.scrollTop = 0; /* Para os demais navegadores */
});
