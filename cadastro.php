<?php
    require 'conexao.php';

    $nome    = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    // Normaliza a senha (remove espaços em branco extras e repetições de caracteres)
    $senhaNormalizada = preg_replace('/\s+/', ' ', $senha);

    // Cria a hash sha1 da senha normalizada
    $senhaHash = sha1($senhaNormalizada);

    $sql = "INSERT INTO login (nome, usuario, senha) VALUES ('$nome', '$usuario', '$senhaHash')";

    if($conn->query($sql) === TRUE){
        echo "<script language='javascript'>
            alert('Cadastro realizado com sucesso!');
            location.href='login.html';
        </script>";
    }else if(($nome == "") && ($usuario == "") && ($senha == "")){
        echo "<script language='javascript'>
            alert('ERRO: Nome, Usuário e Senha não podem estar vázios!');
            location.href='login.html';
        </script>";
    }else{
        echo "<script language='javascript'>
            alert(Erro: Não foi possivel cadastrar. O erro foi: );
            location.href='cadsastro.html';
        </script>" . $conn->error;
    }

    $conn->close();
?>