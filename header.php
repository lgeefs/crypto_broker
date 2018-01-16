<?php

    session_start();
    require_once('functions.php');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crypto Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Styles-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel='stylesheet' type='text/css' href='css/main.css'/>
    <!--/Styles-->

    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src='js/CryptoBroker.js'></script>
    <!--/Scripts-->

</head>
<body>

<?php 
    require_once('navbar.php'); 
?>

<div class="container col-sm-12">
    <div class='spacer-80'></div>