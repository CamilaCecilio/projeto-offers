<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id_usuario'])) {
    die("Você não pode acessar esta página porque não está logado. Favor logar com seu e-mail e senha!<p><a href=\"login.php\">Entrar</a></p>");
}

?>