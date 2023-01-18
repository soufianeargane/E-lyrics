<?php

include_once './classes/loginClass.php';

if (isset($_POST['login'])) {

    // sanitize the data
    function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $user = new User();
    // $user->getUser($email);
    $result = $user->getUser($email);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    // count the number of rows
    $count = $result->rowCount();

    // $errors = array();

    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email is required";
        header('location: login.php');
        die();
    } elseif (empty($password)) {
        $_SESSION['error'] = "Password is required";
        header('location: login.php');
        die();
    }

    if ($count > 0) {
        if ($password == $row['password']) {
            $_SESSION['id'] = $row['id'];
            // extract the username from email using explode
            $username = explode('@', $email);
            $_SESSION['username'] = $username[0];
            $_SESSION['email'] = $row['email'];
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            $_SESSION['error'] = "The password is incorrect";
            header('location: login.php');
        }
    } else {
        $_SESSION['error'] = "The email doesnt exist";
        header('location: login.php');
    }
}
