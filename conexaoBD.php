<?php

//dados de conexão
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database ="bdoffersfast";

            //Conectar ao banco de dados
            try {
                $conn = new mysqli(
                    $hostname,
                    $username,
                    $password,
                    $database
                );
            } catch (Exception $e) {
                die("<div class='alert alert-danger' role='alert'>Erro ao conectar: " . $e->getMessage() . "</div>");
            }

?>
