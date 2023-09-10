<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location: login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="PT-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
        <h2> Bem-vindo, <?php echo $_SESSION['usuario']; ?></h2>
        <p>Conteúdo do dashboard aqui.</p>
        <a href="logout.php">Sair</a>
    </body>
</html>