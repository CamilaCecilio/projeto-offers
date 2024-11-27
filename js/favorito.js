const modal = document.querySelector('.modal'); // Select the modal element
const openButton = document.getElementById('active-modal'); // Replace 'yourButtonId' with your actual button ID
const closeButton = document.querySelector('.btn-secondary'); // Assuming the close button has class 'btn-close'
const element = document.getElementById('active-modal'); // Assuming the element has ID 'myElement'
const id = element.dataset.id;


function openModal() {
    modal.style.display = 'block';
}
function handleClose() {
    modal.style.display = 'none';
}
function openProductModal(event) {
    event.preventDefault(); // Prevent form submission
    openModal(); // Call your existing openModal() function
}

function deletar(id) {
    $.ajax({
        method: "GET",
        url: "actions/deletefav.php",
        data: { produtoID: id },
        success: function (result) {
            alert("Produto deletado com sucesso!");
            handleClose();
            $('#fav-items'+ id).fadeOut(300, function(){ $(this).remove();});
        },
        error: function (result) {
            alert("Não foi possível deletar o produto!")
         }
    }); 
  } 

 

  



