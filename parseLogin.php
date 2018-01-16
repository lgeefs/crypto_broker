<?php

	session_start();

    require_once('conn.php');
    //require_once('functions.php');

	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);

    //lowercase so it is case-insensitive when compared to email in db
	$email = strtolower($email);

    //query for users with this email
    $query = "SELECT * FROM `users` WHERE email='$email'";
    
    $success = false;
    $message = null;

    //if query executes:
	if ($result = $conn->query($query)) {

        //if query returns any results:
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //check if password is correct
            if (password_verify($password, $row['password'])) {

                $success = true;

                //set session's user_id to identify logged in user
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['admin'] = $row['admin'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                
            } else {
                $message = "Invalid password";
            }

        } else {
            $message = "No account associated with this email";
        }

    } else {
        $message = "Could not execute query";
    }

    echo json_encode(array('success' => $success, 'message' => $message));

    $conn->close();

?>