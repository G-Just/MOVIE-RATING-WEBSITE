<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "movie_rating_site";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection to database failed! Error = " . mysqli_connect_error());
}
