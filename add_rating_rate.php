<!DOCTYPE html>
<html lang="en" id='add-rating-rate'>
<?php include 'templates/head.php' ?>
<?php if (!isset($_SESSION['usersID'])) {
    header('location: ../login.php?Fetching...=need_to_log_in');
}
?>
<?php include 'templates/navbar.php' ?>

<div id="rate-container">
    <div id="rate-poster">
        <div class="search-result" id="selected-result"></div>
    </div>
    <div id="rate-form-container">
        <label id='user-guide'>* hover the poster to change selected movie</label>
        <form action="includes_h/add_rating_rate_h.php" method="POST" id="rate-form">
            <h4>Add a rating</h4>
            <hr>
            <div id="rate-info">
                <div>
                    <h5>Title :</h5>
                    <input type="text" style="display:none" name="title">
                    <p class="hero" id="title">Fetching...</p>
                    </input>
                    <input type="text" style="display:none" name="year"></input>
                    <input type="text" style="display:none" name="poster"></input>
                    <input type="text" style="display:none" name="plot"></input>
                </div>
                <div>
                    <h5>Type :</h5>
                    <input type="text" style="display:none" name="type">
                    <p class="hero" id="type">Fetching...</p>
                    </input>
                </div>
                <div>
                    <h5>Genre :</h5>
                    <input type="text" style="display:none" name="genre">
                    <p class="hero" id="genre">Fetching...</p>
                    </input>
                </div>
                <div>
                    <h5>IMDB rating :</h5>
                    <input type="text" style="display:none" name="imdb">
                    <p class="hero" id="imdb">Fetching...</p>
                    </input>
                </div>
                <div id='plot-div'>
                    <h5>Plot:</h5>
                    <p class="hero" id="plot">Fetching...</p>
                </div>
            </div>
            <hr>
            <div id="rating-verdict">
                <div id="verdict-itself-container">
                    <input name='verdict' id='rating-input' type="number" style='display:none'>
                    <p id="rating">Scroll to chose</p></input>
                    <textarea type='text' id='verdict-comment' name='comment' placeholder='Leave a comment... *optional'></textarea>
                </div>
                <?php
                require_once 'includes_h/functions_h.php';
                require_once 'includes_h/database_handler_h.php';
                $title = $_GET['content'];
                $type = $_GET['type'];
                $year = $_GET['year'];
                $movie = moviesGetByTitleTypeYear($title, $type, $year, $conn);
                $ratingExists = assocsGetByIdUsersId($movie['moviesID'], $_SESSION['usersID'], $conn);
                if ($movie === false) {
                    echo "<button style='width: 100%;' 'type='submit' name='submit' id='add-rating-button'>Add rating</button>";
                } else if ($movie != false && $ratingExists !== false) {
                    echo "<label style='position:absolute;bottom:-35px;font-size:10pt;'>*You already rated this movie, new rating will update the old one</label>";
                    echo "<div id='buttons-container' style='width:100%'><button type='submit' name='submit' id='add-rating-button'>Update rating</button>";
                    echo "<button style='width: 20%;' name='submit' value='remove' id='remove-rating-button' onclick='warn_deletion()'>Remove rating</button></div>";
                } else if ($movie != false && $ratingExists === false) {
                    echo "<button style='width: 100%;' 'type='submit' name='submit' id='add-rating-button'>Add rating</button>";
                }
                ?>
            </div>
        </form>
    </div>
</div>
<?php include 'templates/footer.php' ?>