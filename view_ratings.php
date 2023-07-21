<!DOCTYPE html>
<html lang="en" id='view-rating'>
<?php include 'templates/head.php' ?>
<?php if(!isset($_SESSION['usersID'])){
    header('location: ../login.php?error=need_to_log_in');
}
?>
<?php include 'templates/navbar.php' ?>

<?php
    require_once 'includes_h/functions_h.php';
    require_once 'includes_h/database_handler_h.php';

    $sort_by = 'moviesTitle';

    $url_components = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url_components['query'], $params);
    $current_sort = $params['sort'];

    if ($current_sort === "Title"){
        $sort_by = 'moviesTitle';
    }
    if ($current_sort === "Year"){
        $sort_by = 'moviesYear DESC';
    }
    if ($current_sort === "IMDB"){
        $sort_by = 'moviesIMDB DESC';
    }
    if ($current_sort === "DateAdded"){
        $sort_by = 'moviesID';
    }

    $db_movies = moviesGetAll($conn, $sort_by);
    echo "<div id='view-ratings-container'>";

    $ids = 0;
    function CreateMovieDiv($entry, $verdict, $conn, $ids, $final_string, $final){
        echo "<div class='view-ratings-rating'>";
        echo "<img class='view-poster'src=".$entry['moviesPoster']."></img>";
        echo "<h1 id='$ids' class='view-title'>".$entry['moviesTitle']." (".$entry['moviesYear'].")</h1>";
        echo "<div>
        <h5 class='view-type'>".$entry['moviesType']."</h3>
        <h3 class='view-genre'>".$entry['moviesGenre']."</h3>
        <p class='view-imdb'>IMDB rating: ".$entry['moviesIMDB']."</p></div>";
        echo "<div><p class='view-raters'>Users that rated this [ ".count(assocsGetByMovieId($conn, $entry['moviesID']))." ] : ".$final_string."</p></div>";
        echo "<p class='view-final-verdict-name'>Rating</p>";
        echo "<span class='view-final-verdict-span'>
                <p class='view-final-verdict'>$verdict</p>
                <p class='view-final-verdict-comment'></p>
            </span>";
            if (in_array($_SESSION['usersUsername'], $final)){
                echo "<button class='view-movies-rate-movie-button' onclick='add_rating($ids)'>Update your rating</button>";
            }
            else{
            echo "<button class='view-movies-rate-movie-button' onclick='add_rating($ids)'>Rate this movie</button>";
        }
        echo "</div>";
    }


    if (count($db_movies) !== 0){    
    echo "<div id='sort-selector'>
    <p>Sort by:</p>
    <form id='sort-form' action='includes_h/view_ratings_h.php' method='POST'>
    <select name='sort-by' id='sort-selectors'>
    <option value='moviesTitle'>Title</option>
    <option value='moviesYear'>Year</option>
    <option value='moviesIMDB'>IMDB</option>
    <option value='moviesID'>Date added</option>
    <option value='rated-by-me'>Rated by me</option>
    <option value='not-rated-by-me'>Not rated by me</option>
    </select>
    </form>
    </div>";
    foreach ($db_movies as $entry){
        $rating = 0;
        $counter = 0;
        $db_assocs = assocsGetByMovieId($conn, $entry['moviesID']);
        $final = array();
        foreach ($db_assocs as $entries){
            $username = (usersGetByID($entries['assocsUsersID'], $conn));
            $score = assocsGetByMoviesIdUsersId($entry['moviesID'], $entries['assocsUsersID'], $conn);
            array_push($final, $username['usersUsername']." - ".$score['assocsUsersVerdict']);
        }
        foreach ($db_assocs as $ratings){
            $counter += 1;
            $rating += $ratings['assocsUsersVerdict'];
        }
        if($counter !== 0){
            $verdict = $rating/$counter;
        }
        else{
            $verdict = "FAILED";
        }
        $final_string = implode(", ", $final);

        if ($current_sort === "Rated_by_me"){
            if (!in_array($_SESSION['usersUsername'], $final)) {
                CreateMovieDiv($entry, $verdict, $conn, $ids, $final_string, $final);
                $ids += 1;
            }
        }
        else if ($current_sort === "Not_rated_by_me"){
            if (in_array($_SESSION['usersUsername'], $final)) {
                CreateMovieDiv($entry, $verdict, $conn, $ids, $final_string, $final);
                $ids += 1;
            }
        }
        else{
            CreateMovieDiv($entry, $verdict, $conn, $ids, $final_string, $final);
            $ids += 1;
    }
}
    }
    else{
        echo "<h1 class='empty-message'>No content !</h1>";
    }
    echo "</div>";
?>

<?php include 'templates/footer.php' ?>