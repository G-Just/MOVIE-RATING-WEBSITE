<?php

if (isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    require 'functions_h.php';
    require 'database_handler_h.php';
    loginUser($email, $password, $conn);
    $cookie = $_COOKIE['remember'] ?? null;
    if ($remember === 'on' && $cookie !== null){
        setRememberCookie($conn);
    }
    if(!$remember){
        removeRememberCookie($conn);
    }
    header('location: ../home.php?error=logged_in');
}
else{
    header('location: ../login.php');
}