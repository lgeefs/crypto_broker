<?php

    $binanceAPIUrl = "https://api.binance.com";
    $binanace_ini = parse_ini_file("../config/binance_api.ini");
    $binanace_key = $binanace_ini['api_key'];
    $binanace_secret = $binanace_ini['api_secret'];

    function getAccounts($query) {

        require('conn.php');

        $query = "SELECT * FROM accounts ".$query;

        $accounts = [];
        $success = false;
        $message = null;

        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_assoc()) {

                $account = [];

                foreach($row as $key => $value) {
                    $account[$key] = $value;
                }

                $accounts[] = $account;

            }

            $success = true;

        }

        return json_encode(array(
            "accounts" => $accounts,
            "success" => $success,
            "message" => $message
        ));

    }

    function insertAccounts($accounts) {

        require('conn.php');

        $insertQuery = "INSERT INTO accounts (account_id, first_name, last_name, email) VALUES ";

        $already_inserted = [];

        $prependComma = false;
        foreach ($accounts as $a) {
            if (!in_array($a['email'], $already_inserted)) {
                $account_id = uniqid('acc');
                $comma = $prependComma ? ", " : "";
                $insertQuery .= "$comma(
                    '".$account_id."',
                    '".$a['first_name']."',
                    '".$a['last_name']."',
                    '".$a['email']."'
                )";
                $already_inserted[] = $a['email'];
                $prependComma = true;
            }
        }

        if ($result = $conn->query($insertQuery)) {

            echo "success";

        } else {
            echo mysqli_error($conn);
        }

    }

    function insertTransactions($transactions) {

        require('conn.php');

        $insertQuery = "INSERT INTO transactions (
            transaction_id,
            account_id,
            investment,
            asset_name,
            quantity,
            cost,
            deposit_percentage,
            withdraw_percentage,
            exchange_account,
            action,
            referred_by_id
        ) VALUES ";

        $prependComma = false;
        foreach ($transactions as $t) {
            $transaction_id = uniqid('t');
            $comma = $prependComma ? ", " : "";
            $insertQuery .= "$comma(
                '".$transaction_id."',
                '".$t['account_id']."',
                '".$t['investment']."',
                '".$t['asset_name']."',
                '".$t['quantity']."',
                '".$t['cost']."',
                '".$t['deposit_percentage']."',
                '".$t['withdraw_percentage']."',
                '".$t['exchange_account']."',
                '".$t['action']."',
                '".$t['referred_by_id']."'
            )";
            $prependComma = true;
        }

        //echo $insertQuery."<br />";

        if ($result = $conn->query($insertQuery)) {

            echo "success";

        } else {
            echo mysqli_error($conn);
        }

    }

    function getTransactions($query) {

        require('conn.php');

        $query = "SELECT * FROM transactions ".$query;

        $transactions = [];
        $success = false;
        $message = null;

        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_assoc()) {

                $t = [];

                foreach ($row as $key => $value) {
                    $t[$key] = $value;
                }

                $transactions[] = $t;

            }

            $success = true;

        } else {
            $message = mysqli_error($conn);
        }

        return json_encode(array(
            "transactions" => $transactions
            ,"success" => $success
            ,"message" => $message
        ));

    }

    function getBinancePrice($ticker) {

        global $binanceAPIUrl;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$binanceAPIUrl/api/v1/ticker/24hr?symbol=$ticker");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        
        //$headers = array();
        //$headers[] = "Authorization: Bearer ".$_SESSION['api_key'];
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return('Error:' . curl_error($ch));
        }
        curl_close ($ch);

        return $result;

    }

?>