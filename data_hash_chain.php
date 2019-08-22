<?php
    $secret = "s3cr3t";
    $hashed_filename = "MOCK_DATA_CHAIN_HASHED.csv";
    $raw_data = file("MOCK_DATA.csv");
    $previous_hash = "";
    
    foreach($raw_data as $data){
        $final_data = trim($data);
        $splitted_data = explode(",",$data);
        $data = trim($splitted_data[0]).trim($splitted_data[1]).trim($splitted_data[2]).trim($splitted_data[3]);
        $hash = hash("sha256",str_replace(",","",$data).$secret.$previous_hash);
        $final_data = $final_data.",".$hash;
        $previous_hash = $hash;
        file_put_contents($hashed_filename,$final_data."\r\n",FILE_APPEND);
    }
?>