<?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém o hash alvo do formulário
        $hashAlvo = $_POST["hashAlvo"];

        // Configurações do banco de dados
        $host = "127.0.0.1:3310";
        $usuarioBD = "root";
        $senhaBD = "";
        $bancoDados = "segurancainfo";

        //Conecta ao banco de dados
        $conn = new mysqli($host, $usuarioBD, $senhaBD, $bancoDados);

        //Verifica se a conexão foi bem-sucedida
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        //Consulta para obter a senha criptografada
        $sql = "SELECT senha FROM login WHERE senha = ?";
        
        //Verifica se a preparação da consulta foi bem-sucedida
        $stmt = $conn->prepare($sql);
        if(!$stmt){
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $hashAlvo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            //Senha encontrada no banco de dados
            $stmt->bind_result($senhaEncontrada);
            $stmt->fetch();

            //Consulta para salvar a senha no banco de dados
            $sqlSalvarSenha = "INSERT INTO senhas_encontradas(senhas) VALUES (?)";
            
            //Verifica se a preparação da consulta foi bem-sucedida
            $stmtSalvarSenha = $conn->prepare($sqlSalvarSenha);
            if(!$stmtSalvarSenha){
                die("Erro na preparação da consulta de inserção: ".$conn->error);
            }

            $stmtSalvarSenha->bind_param("s", $senhaEncontrada);

            if($stmtSalvarSenha->execute()) {
                echo "Senha encontrada no banco de dados e salva na tabela 'senhas_encontradas'.<br>";
                echo "<input type='button' value='Voltar' onclick='history.go(-1)'/>";
                echo "<script>
                $(document).ready(function(){
                     $(window).scroll(function(){
                         if ($(this).scrollTop() > 100) {
                             $('a[href=''top']').fadeIn();
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
                echo "Erro ao salvar a senha no banco de dados: ".$stmtSalvarSenha->error;
            }

            //Fecha a consulta de inserção
            $stmtSalvarSenha->close();
        }else{
            echo "<script language='javascript'>
                alert('Senha não encontrada no banco de dados!');
                location.href='dicionario.html'
            </script>";
        }

        //Fecha a consulta de seleção
        $stmt->close();
        //Fecha a conexão com o banco de dados
        $conn->close();
    }
?>
