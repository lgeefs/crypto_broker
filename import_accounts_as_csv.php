<?php

    session_start();

    require_once('functions.php');

    $file = fopen( 'test.csv', "r+" );

    $accounts = [];
    
    if (!empty($file)) {
        $skip = true;
        while ($line = fgetcsv($file, 1000, ",")) {
            if ($skip) {
                $skip = false;
                continue;
            }
            $name = explode(' ', $line[0]);
            $account = array(
                "first_name" => $name[0]
                ,"last_name" => $name[1]
                ,"email" => $line[15]
            );
            array_push($accounts, $account);
        }
        print_r($accounts);
        fclose($file);
    }
    
    if (!empty($accounts) && count($accounts) > 0) {
        insertAccounts($accounts);
    }

?>