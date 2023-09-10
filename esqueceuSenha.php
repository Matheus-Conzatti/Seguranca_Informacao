<?php
    require 'conexao.php';

    //Verificar se o formulario foi enviado
    if(isset($_POST['submit'])){
        //Obtém os dados dos formularios
        $usuario = $_POST['usuario'];
        $newPassword = $_POST['newPassword'];

        //Verifica se o usuario existe no banco de daos
        $query = "SELECT * FROM login WHERE usuario = '$usuario'";
        $result = $conn->query($query);

        if($result->num_rows == 1){
            //Atualiza a senha do usuário
            $query = "UPDATE login SET senha = '$newPassword' WHERE usuario = '$usuario'";
            $conn->query($query);

            echo "<script language='javascript'>
                alert('Senha atualizada com sucesso!');
                location.href='login.html';
            </script>";
        }else{
            //Exibe uma mensagem de erro
            echo "Email não encontrado no banco de dados.";
        }

        //Fecha a conexão com banco de dados
        $conn->close();
    }
?>
