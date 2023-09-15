<?php
    //Hash de senha a ser verificada (substitua pelo seu proprio hash)
    $hashAlvo = ""; //Isso é 'senha' criptografada

    //Caminho para o arquivo de dicinário de senha
    $arquivoDiconario = 'dicinario.txt';

    //Abra o arquivo de dicionario
    $handle = fopen($arquivoDiconario, "r");
    
    if($handle){
        while(($linha = fgets($handle)) !== false){
            $senha trim($linha); //Limpa espaços em branco e quebra de linha

            //Verifica se a hash senha no dicionario correspinde ao hash do alvo
            if(sha256($senha) === $hashAlvo){
                echo "Senha encontrada no dicionário: $senha";
                break;
            }
        }
        fclose($handle);
    }else{
        echo "Erro ao abrir o arquivo de dicionário.";
    }
?>