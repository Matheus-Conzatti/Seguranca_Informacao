<?php
    $servidor = "127.0.0.1:3306";
    $usuario = "root";
    $senha = "";
    $dbname = "segurancainfo";

    //Cria a conexão com o banco
    $conn = new mysqli($servidor, $usuario, $senha, $dbname);

    //Verifica a conexão com o banco
    if($conn->connect_error){
        die("Conexão falhou: ".$conn->connect_error);
    }
?>