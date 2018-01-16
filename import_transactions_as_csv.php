<?php

    session_start();

    require_once('functions.php');

    //Print file details
    //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    $file = fopen( "test.csv", "r+" );

    $transactions = [];
    
    if (!empty($file)) {
        $skip = true;
        while ($line = fgetcsv($file, 1000, ",")) {
            if ($skip) {
                $skip = false;
                continue;
            }
            $query = "WHERE email='".$line[15]."' LIMIT 1";
            $account_id = json_decode(getAccounts($query), true)['accounts'][0]['account_id'];
            $transaction = array(
                "account_id" => $account_id
                ,"investment" => $line[1]
                ,"asset_name" => $line[8]
                ,"quantity" => $line[3]
                ,"cost" => doubleval($line[6])
                ,"deposit_percentage" => $line[9]
                ,"withdraw_percentage" => $line[10]
                ,"exchange_account" => $line[4]. " (".$line[5].")"
                ,"action" => $line[2]
                ,"referred_by_id" => $line[19]
            );
            array_push($transactions, $transaction);
        }
        fclose($file);
    }
    
    if (!empty($transactions) && count($transactions) > 0) {
        insertTransactions($transactions);
    }

?>