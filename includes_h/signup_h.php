<?php
if (isset($_POST['submit'])) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    require_once 'functions_h.php';
    require_once 'database_handler_h.php';

    if (usersGetByUsername($name, $conn) !== false) {
        header('location: ../signup.php?error=user-taken');
        exit();
    }
    if (usersGetByEmail($email, $conn) !== false) {
        header('location: ../signup.php?error=email-taken');
        exit();
    }
    createUser($email, $name, $password, $conn);
} else {
    header('location: ../signup.php');
}
