<?php

if (isset($_POST['submit'])){

    require 'functions_h.php';
    require 'database_handler_h.php';

    $type = $_POST['type'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $verdict = $_POST['verdict'];
    $imdb = $_POST['imdb'];
    $plot = $_POST['plot'];
    $poster = $_POST['poster'];
    $comment = $_POST['comment'];

    $delete = $_POST['submit'];

    if ($delete === 'remove'){
        $movieID = moviesGetByTitleTypeYear($title, $type, $year, $conn);
        $userID = $_SESSION['usersID'];
        assocsDeleteByMovieIdUsersId($conn, $movieID['moviesID'], $userID);
    }
    else{
        addMovie($type, $title, $year, $genre, $imdb, $plot, $poster, $conn);
        rateMovie($verdict, $title, $type, $year, $comment, $conn);
    }
}
else{
    header('location: ../add_rating.php');
}