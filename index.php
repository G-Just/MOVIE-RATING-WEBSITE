<!DOCTYPE html>
<html lang='en' id='index'>
<?php

session_start();
session_unset();
session_destroy();

header("location: ../home.php");