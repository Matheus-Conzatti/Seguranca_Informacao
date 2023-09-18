<?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém o hash alvo do formulário
        $hashAlvo = $_POST["hashAlvo"];

        // Caminho para o arquivo de dicionário de senhas
        $arquivoDicionario = "dicionario.txt";

        // Abre o arquivo de dicionário de senhas
        $handle = fopen($arquivoDicionario, "r");

        if ($handle) {
            while (($linha = fgets($handle)) !== false) {
                $senha = trim($linha); // Limpa espaços em branco e quebras de linha

                // Calcula o hash SHA-256 da senha do dicionário
                $hashSenha = hash('sha256', $senha);

                // Verifica se o hash da senha do dicionário corresponde ao hash alvo
                if ($hashSenha === $hashAlvo) {
                    $senhaEncontrada = $senha;
                    break; // Se encontrou a senha, podemos parar.
                }
            }
            fclose($handle);

            // Se uma senha foi encontrada, salve-a em um arquivo
            if (isset($senhaEncontrada)) {
                $arquivoSalvo = "senha_encontrada.txt";
                file_put_contents($arquivoSalvo, $senhaEncontrada);
                echo "Senha encontrada no dicionário: $senhaEncontrada e salva em $arquivoSalvo";
                
            } else {
                echo "<script language='javascript'>
                alert('Senha não encontrada!');
                location.href='dicionario.html';
            </script>";
            }
        } else {
            echo "<script language='javascript'>
                alert('Erro ao abrir o arquivo de dicionário!');
                location.href='dicionario.html';
            </script>";
        }
    }
?>
