<?php

    require_once('header.php');

    $transactions = json_decode(getTransactions(), true)['transactions'];

    echo "<table class='table table-bordered'>";

    echo "<tr><th>Transaction ID</th><th>Account ID</th><th>Investment</th><th>Asset</th><th>Quantity</th><th>Cost</th><th>Currency</th><th>Deposit %</th><th>Withdraw %</th><th>Exchange</th><th>Action</th><th>Referred By</th><th>Date</th></tr>";

    foreach($transactions as $t) {

        echo "<tr>";
        
        foreach ($t as $k => $v) {

            echo "<td>".$v."</td>";

        }

        echo "</tr>";

    }

    echo "</table>";

    require_once('footer.php');

?>