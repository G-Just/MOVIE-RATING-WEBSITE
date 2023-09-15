<?php

$sort_by = $_POST['sort-by'];
if ($sort_by === "moviesTitle") {
    header("location: ../view_ratings.php?sort=Title");
}
if ($sort_by === "moviesYear") {
    header("location: ../view_ratings.php?sort=Year");
}
if ($sort_by === "moviesIMDB") {
    header("location: ../view_ratings.php?sort=IMDB");
}
if ($sort_by === "moviesID") {
    header("location: ../view_ratings.php?sort=DateAdded");
}
if ($sort_by === "rated-by-me") {
    header("location: ../view_ratings.php?sort=Rated_by_me");
}
if ($sort_by === "not-rated-by-me") {
    header("location: ../view_ratings.php?sort=Not_rated_by_me");
}
