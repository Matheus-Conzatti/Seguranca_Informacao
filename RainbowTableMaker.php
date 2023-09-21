<?php

    class RainbowTable
    {
        function HashReverse($hash){

            $wordList = "wordlList.txt";
            $foundkeys = "foundKeys.txt";
            
            $fileWordList = fopen($wordList, 'r');
            $fileKeys = fopen($foundkeys, 'w+');

            $lines = [];
            while(!feof($fileWordList)){
                $lines[] = fgets($fileWordList);
            }

            // foreach($lines as $line){
                
            //     $hashRainbow = hash('sha256',trim($line));
            //     if ($hashRainbow === trim($hash)) {
            //         fwrite($fileKeys, $line);
            //     }
            // }

            foreach ($lines as $line) {
                $hashRainbow = hash('sha256',trim($line));
                
                if (trim($hashRainbow) === trim($hash)) {
                    fwrite($fileKeys, $line);
                }
            }
            
            fclose($fileWordList);
            fclose($fileKeys);
        }
    }
?>