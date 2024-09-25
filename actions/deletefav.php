<?php
    include("../conexaoBD.php");

    if(isset($_GET['produtoID'])){
       $produtoID = $_GET['produtoID'];
       $sql = "UPDATE produto SET favorito = 0 WHERE id_produto = $produtoID";
       $conn->query($sql); 
    }
    
?>