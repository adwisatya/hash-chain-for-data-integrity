<?php
    $secret = "s3cr3t";
    $raw_data = file("MOCK_DATA_CHAIN_HASHED.csv");
    $previous_hash = "";
    
    foreach($raw_data as $data){
        $splitted_data = explode(",",trim($data));
        $data = trim($splitted_data[0]).trim($splitted_data[1]).trim($splitted_data[2]).trim($splitted_data[3]);
        $hash = hash("sha256",str_replace(",","",$data).$secret.$previous_hash);
        $previous_hash = $hash;
        if($hash != $splitted_data[4]){
            file_put_contents("hash_checker.log",$splitted_data[0]."|".$splitted_data[4]."|".$hash."\n",FILE_APPEND);
        }
    }
?>