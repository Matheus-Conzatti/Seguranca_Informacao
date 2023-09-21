<?php
    require 'RainbowTableMaker.php';
    require 'conexao.php';

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //---------------------------------------------------
        $Rain = new RainbowTable();
        $query = "SELECT senha FROM login";
        $result = $conn->query($query);

        // Verifica se a consulta foi bem-sucedida
        if ($result->num_rows > 0) {
            while ($line = $result->fetch_assoc()) {
                $Rain->HashReverse($line['senha']);
            }
        } 
        else {
            echo "Nenhum resultado encontrado.";
        }
        //-------------------------------------------------------
    }
?>
