<?php
//SISTEMA DE SAÍDA DA CONTA DO USUÁRIO 
    session_start();
    session_destroy();   // DESTRÓI A SESSÃO ATUAL
    header("Location: ../paginalogin.html"); //DIRECIONA O USUÁRIO PARA A PÁGINA DE REGISTRO
?>