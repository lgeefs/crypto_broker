<?php

    require_once('header.php');

    $accounts = json_decode(getAccounts(), true)['accounts'];

    echo "<table class='table table-bordered'>";

    echo "<tr><th>Account</th><th>Value</th><th>Asset</th><th>Quantity</th><th>Cost</th><th>Deposit %</th><th>Withdraw %</th><th>Exchange</th><th>Action</th><th>Referred By</th><th>Date</th></tr>";

    $coin_prices = [];
    $coin_prices['btcusdt'] = json_decode(getBinancePrice('BTCUSDT'), true)['lastPrice'];
    $coin_prices['ethusdt'] = json_decode(getBinancePrice('ETHUSDT'), true)['lastPrice'];
    $coin_prices['usdcad'] = 1.25;
    $coin_prices['btccad'] = $coin_prices['btcusdt'] * $coin_prices['usdcad'];
    $coin_prices['ethcad'] = $coin_prices['ethusdt'] * $coin_prices['usdcad'];
    $coin_prices['btceth'] = $coin_prices['btccad'] / $coin_prices['ethcad'];

    $our_total_cad_profits = 0;

    foreach($accounts as $a) {

        $query = "WHERE account_id='".$a['account_id']."'";

        error_log($query);

        $transactions = json_decode(getTransactions($query), true)['transactions'];

        $investment = [];
        $investment_value = [];
        $investment_quantity = [];
        $investment_cost_currency = [];
        $actual_investment = [];

        foreach ($transactions as $t) {

            if (!array_key_exists($t['asset_name'], $coin_prices)) {
                $coin_prices[$t['asset_name']] = json_decode(getBinancePrice($t['asset_name']."BTC"), true)['lastPrice'];
            }

            $actual_investment[$t['asset_name']] += doubleval($t['investment']);
            $investment[$t['asset_name']] += doubleval($t['quantity']) * doubleval($t['cost']);
            $investment_value[$t['asset_name']] += doubleval($t['quantity']) * doubleval($coin_prices[$t['asset_name']]);
            $investment_quantity[$t['asset_name']] += doubleval($t['quantity']);
            $investment_cost_currency[$t['asset_name']] = $t['cost_currency'];

            if (isset($t['withdraw_percentage'])) {
                $a['withdraw_percentage'] = $t['withdraw_percentage'];
            }

        }

        $coin_cost = [];
            
        foreach ($investment as $key => $value) {
            $coin_cost[$key] = doubleval($investment[$key]) / doubleval($coin_prices['btc'.strtolower($investment_cost_currency[$key])]);
        }
        

        foreach ($investment as $key => $value) {
            if (isset($investment[$key])) {
                echo "<tr>";
                echo "<td>".$a['first_name']." ".$a['last_name']."</td>";
                $quantity = $investment_quantity[$key];
                $btc_invy = $coin_cost[$key];
                $cad_invy = $actual_investment[$key];
                $btc_value = $coin_prices[$key] * $investment_quantity[$key];
                $cad_value = $coin_prices[$key] * $investment_quantity[$key] * $coin_prices['btccad'];
                $cad_profit = ($cad_value - $cad_invy) * ((100 - intval($a['withdraw_percentage'])) / 100);
                $our_cad_profit = ($cad_value * (intval($a['withdraw_percentage']) / 100));
                $our_total_cad_profits += $our_cad_profit;
                echo "<td>$quantity"."$key</td>";
                echo "<td>Investment: ".$btc_invy."btc ($".$cad_invy."CAD)</td>";
                echo "<td>Value: ".$btc_value."btc ($".$cad_value."CAD)</td>";
                echo "<td>Their profit: $".$cad_profit."CAD</td>";
                echo "<td>Our profit: $".$our_cad_profit."CAD</td>";
                echo "</tr>";
            }
        }


    }

    echo "<tr><td></td><td></td><td></td><td></td>"; //don't delete this line
    echo "<td></td>";
    echo "<td>Our Total Profit: $".$our_total_cad_profits."CAD</td></tr>";

    echo "</table>";

    require_once('footer.php');

?>