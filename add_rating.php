<!DOCTYPE html>
<html lang="en" id='add-rating'>
<?php include 'templates/head.php' ?>
<?php if(!isset($_SESSION['usersID'])){
    header('location: ../login.php?error=need_to_log_in');
}
?>
<?php include 'templates/navbar.php' ?>

<div id='search-box'>
    <input type="text" id="search-text" placeholder="Select a subject...">
    <div id='search-results'></div>
    
<?php include 'templates/footer.php' ?>