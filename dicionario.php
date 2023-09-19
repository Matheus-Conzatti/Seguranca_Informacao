<?php
    //Verifica se o formulario foi envido
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Obtem o hash alvo do formulario
        $hashAlvo = $_POST["hashAlvo"];

        //Configurações do banco de dados
        $host = "127.0.0.1:3310";
        $usuarioBD = "root";
        $senhaBD = "";
        $bancoDados = "segurancainfo";

        //Conecta ao banco de dados
        $conn = new mysqli($host, $usuarioBD, $senhaBD, $bancoDados);

        //Verifica se a conexão foi bem-sucedida
        if($conn->connect_error){
            die("Erro na conexão com o banco de dados:". $conn->connect_error);
        }

        //Consulta para verificar a senha
        $sql = "SELECT senha FROM login WHERE senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hashAlvo);
        $stmt->execute();
        $stmt->store_result();

        if($smtm->num_row > 0){
            //Senha encontrada do banco de dados
            $smtm->bind_result($senhaEncontra);
            $smtm->fetch();

            //Salve a senha em um arquivo
            $arquivoSalvo = "Senha_encontrada.txt";
            file_put_contents($arquivoSalvo, $senhaEncontra);
            echo "Senha encontrada no banco de dados: $senhaEncontrada e salva em $arquivoSalvo";
        }else{
            echo "<script language='javascript'>
                alert('Senha não encontrada no banco de dados!');
                location.href='dicionario.html'
            </script>";
        }

        //Fecha a conexão e a consulta 
        $stmt->close();
        $conn->close();
    }
?>