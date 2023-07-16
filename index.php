<!DOCTYPE html>
<html lang='en' id='index'>
<?php

session_start();
session_unset();
session_destroy();

require_once 'includes_h/functions_h.php';
require_once 'includes_h/database_handler_h.php';
if (checkForRememberCookie($conn)){
    SESSION_start();
    $ID = checkForRememberCookie($conn)['cookiesUserID'];
    $email = userIDCheck($ID, $conn)['usersEmail'];
    $user = userEmailExistsCheck($email, $conn);
    $_SESSION['usersID'] = $user['usersID'];
    $_SESSION['usersUsername'] = $user['usersUsername'];
    $_SESSION['usersEmail'] = $user['usersEmail'];
    header('location: ../home.php?error=logged_in');
    exit();
}

header("location: ../home.php");