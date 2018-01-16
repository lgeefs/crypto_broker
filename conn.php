<?php

    $conn_details = parse_ini_file('/Applications/MAMP/htdocs/config/crypto_broker.ini');

    $dbhost = $conn_details['dbhost'];
    $dbuser = $conn_details['dbuser'];
    $dbpass = $conn_details['dbpass'];
    $dbname = $conn_details['dbname'];

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) {
        echo "Error establishing connecting to db :(";
        echo mysqli_error($conn);
    }

?>