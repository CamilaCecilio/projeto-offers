<?php
// Conexão com o banco de dados
include "../conexaoBD.php";

if (isset($_GET['produtoID'])){
    $produtoID = $_GET['produtoID'];
    $status = '';
    $saida = '';
    if ($_GET['fav_status']==0){
        $status = 1;
        $saida = 'favon';
    }
    else {
        $status = 0;
        $saida = 'favoff';
    }

    $sql = "UPDATE produto SET favorito = $status WHERE id_Produto = $produtoID";
    $conn->query($sql); 
    echo $saida;
} ?>