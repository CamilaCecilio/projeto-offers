
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

