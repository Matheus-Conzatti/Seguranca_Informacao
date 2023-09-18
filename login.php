<?php
    use function validation\GetUserIp;
    session_start();
    require 'conexao.php';
    require 'checkAttempt.php';

    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];


    $_SESSION['attempts'] = $_SESSION['attempts'] == NULL ? 0 : $attempts;

    // Normaliza a senha (remove espaços em branco extras e repetições de caracteres)
    $senhaNormalizada = preg_replace('/\s+/', ' ', $senha);

    // Cria a hash sha256 da senha normalizada
    $senhaHash = hash('sha256',$senhaNormalizada);

    $stmt = $conn->prepare("SELECT * FROM login WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        if ($senhaHash === $row['senha']) {
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php");
            exit();
        }else if(($usuario === " ") || ($senhaHash === " ")){
            echo "<script language='javascript'>
                    alert('ERRO: Usuário e Senha não podem estar vazios!');
                    location.href='login.html';
                </script>";
        }else{
            echo "<script language='javascript'>
                    alert('ERRO: Credenciais inválidas!');
                    location.href='login.html';
                </script>";
        }
    }else{
        
        if($attempts >= 3){
            echo "<script language='javascript'>
                alert('ERRO: Número de tentativas excedido!');
                location.href='login.html';
                </script>";
        }else{
            echo "<script language='javascript'>
                alert('ERRO: Credenciais inválidas!');
                location.href='login.html';
                </script>";
        }
    }

    $stmt->close();
    $conn->close();
?>
