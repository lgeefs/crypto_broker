<?php

    session_start();

    //require our database connection file
    require('conn.php');
    //require our php functions file
    //require_once('functions.php');

    //generate a random userid to set for the user's id
    $user_id = uniqid('user');

    $password = $conn->real_escape_string($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = strtolower($conn->real_escape_string($_POST['email']));

    //query database to check if email has already been registered
    $query = "SELECT * FROM `users` WHERE email='$email'";

    //declare boolean which will determine if user was successfully registered
    $success = false;
    $message = null;

    //check if query executes
    if ($result = $conn->query($query)) {

        //check if query returned any results
        //if the query returned no results, then the email is available to register
        if ($result->num_rows < 1) {

            //setup db insert query
            $insertQuery = "INSERT INTO users (user_id, email, first_name, last_name, password)
            VALUES ('$user_id', '$email', '$first_name', '$last_name', '$password')";
    
            //execute query
            if ($insertResult = $conn->query($insertQuery)) {
                
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;

                $success = true;
                $message = "";

                //sendWelcomeEmail($email);

            } else {
                $message = $insertQuery;
                //$message = "Could not insert into database";
            }

        } else {
            $message = "This email is already associated with an account";
        }

    } else {
        $message = "Could not execute query";
    }

    error_log(mysqli_error($conn));

    echo json_encode(array('user' => array('user_id' => $_SESSION['user_id'], 'first_name' => $_SESSION['first_name']), 'success' => $success, 'message' => $message));

    $conn->close();

?>