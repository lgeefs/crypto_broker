<?php 

    require_once('header.php');

?>
<?php
    
    $all_tickers = json_decode(getAllBinancePrices(), true);

    foreach($all_tickers as $t) {
        echo "<div class='col-sm-3'>";
        echo $t['symbol'];
        echo $t['price'];
        echo "</div>";
    }

?>
<?php 

    require_once('footer.php');

?>