<?php

if (isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    require_once 'functions_h.php';
    require_once 'database_handler_h.php';

    loginUser($email, $password, $conn);
}
else{
    header('location: ../login.php');
}