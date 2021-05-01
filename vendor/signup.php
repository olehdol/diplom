<?php

    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users_reg` (`id`, `login`, `email`, `password`) VALUES (NULL, '$login', '$email', '$password')");
        
        $_SESSION['toastr'] = array(
            'type'      => 'success', // or 'success' or 'info' or 'warning'
            'message' => 'Registration was successful'
        );


        $_SESSION['message'] = 'Registration was successful';
        header('Location: ../index.php');

       

    }else {
        $_SESSION['toastr'] = array(
            'type'      => 'error', // or 'success' or 'info' or 'warning'
            'message' => 'Passwords do not match',
            'title'     => 'ERROR'
        );
        header('Location: ../index.php');
    }

