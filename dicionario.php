<?php
    //Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtém o hash alvo do formulário
        $hashAlvo = $_POST["hashAlvo"];

        //Configurações do banco de dados
        $host = "127.0.0.1:3310";
        $usuarioBD = "root";
        $senhaBD = "";
        $bancoDados = "segurancainfo";

        //Conecta ao banco de dados
        $conn = new mysqli($host, $usuarioBD, $senhaBD, $bancoDados);

        // Verifica se a conexão foi bem-sucedida
        if($conn->connect_error){
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        //Consulta para verificar a senha
        $sql = "SELECT senha FROM login WHERE senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hashAlvo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            //Senha encontrada no banco de dados
            $stmt->bind_result($senhaEncontrada);
            $stmt->fetch();

            //Salve a senha em um arquivo
            $arquivoSalvo = "Senha_encontrada.txt";
            file_put_contents($arquivoSalvo, $senhaEncontrada);
            echo "Senha encontrada no banco de dados: $senhaEncontrada e salva em $arquivoSalvo.";
            echo "<br>";
            echo "<input type='button' value='Voltar' onclick='history.go(-1)'/>";
            echo "<script>
                $(document).ready(function(){
                $(window).scroll(function(){
                    if ($(this).scrollTop() > 100) {
                    $('a[href='#top']').fadeIn();
                    } else {
                    $('a[href='#top']').fadeOut();
                    }
                });
        
                $('a[href='#top']').click(function(){
                    $('html, body').animate({scrollTop : 0},800);
                    return false;
                });
                });
            </script>";
        }else{
            echo "<script language='javascript'>
                alert('Senha não encontrada no banco de dados!');
                location.href='dicionario.html';
            </script>";
        }

        // Fecha a conexão e a consulta
        $stmt->close();
        $conn->close();
    }
?>
