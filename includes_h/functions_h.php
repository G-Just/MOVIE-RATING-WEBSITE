<?php

SESSION_start();

function databaseConnectionCheck($stmt, $sql){
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../home.php?error=database_connection_failed');
        exit();
    }
}

// =============== USERS DATABASE FUNCTIONS ===============

function usersGetByUsername($username, $conn) {
    $sql = "SELECT * FROM users WHERE usersUsername = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result_data = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function usersGetByEmail($email, $conn) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result_data = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function usersGetByID($ID, $conn) {
    $sql = "SELECT * FROM users WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);

    $result_data = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createUser($email, $username, $password, $conn) {
    $sql = "INSERT INTO users (usersEmail, usersUsername, usersPassword) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../login.php?error=user_created');
}

function loginUser($email, $password, $conn){
    $user = usersGetByEmail($email, $conn);
    if ($user === false){
        header('location: ../login.php?error=wrong-email');
        exit();
    }
    $passwordHashed = $user['usersPassword'];
    if (!password_verify($password, $passwordHashed)){
        header('location: ../login.php?error=wrong-password');
        exit();
    }
    SESSION_start();
    $_SESSION['usersID'] = $user['usersID'];
    $_SESSION['usersUsername'] = $user['usersUsername'];
    $_SESSION['usersEmail'] = $user['usersEmail'];
}

// =============== MOVIES DATABASE FUNCTIONS ===============

function moviesGetByTitleTypeYear($title, $type, $year, $conn){
    $sql = "SELECT * FROM movies WHERE moviesTitle = ? AND moviesType = ? AND moviesYear = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $title, $type, $year);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function addMovie($type, $title, $year, $genre, $imdb, $plot, $poster, $conn){
    $movie = moviesGetByTitleTypeYear($title, $type, $year, $conn);
    if ($movie === false){
        $sql = "INSERT INTO movies (moviesType, moviesTitle, moviesYear, moviesGenre, moviesIMDB, moviesPlot, moviesPoster) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        databaseConnectionCheck($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdss", $type, $title, $year, $genre, $imdb, $plot, $poster);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

function moviesGetAll($conn, $sortby){
    $sql = "SELECT * FROM movies ORDER BY ".$sortby.";";
    $search = mysqli_query($conn, $sql);
    $result_data = mysqli_fetch_all($search, MYSQLI_ASSOC);
    return $result_data;
}

// =============== ASSOCS DATABASE FUNCTIONS ===============

function updateRating($verdict, $title, $type, $year, $comment, $conn){
    $movie = moviesGetByTitleTypeYear($title, $type, $year, $conn);
    $sql = "UPDATE assocs SET assocsUsersVerdict = ?, assocsComment = ? WHERE assocsMoviesID = ? and assocsUsersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "isii", $verdict, $comment, $movie['moviesID'], $_SESSION['usersID']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../view_ratings.php?error=content_rating_updated');
}

function assocsGetByIdUsersId($movieID, $userID, $conn){
    $sql = "SELECT * FROM assocs WHERE assocsMoviesID = ? AND assocsUsersID = ? ;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $movieID, $userID);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function rateMovie($verdict, $title, $type, $year, $comment, $conn){
    $movie = moviesGetByTitleTypeYear($title, $type, $year, $conn);
    if (assocsGetByIdUsersId($movie['moviesID'], $_SESSION['usersID'], $conn) === false){
        $sql = "INSERT INTO assocs (assocsMoviesID, assocsUsersID, assocsUsersVerdict, assocsComment) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        databaseConnectionCheck($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "iiis", $movie['moviesID'], $_SESSION['usersID'], $verdict, $comment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('location: ../view_ratings.php?error=content_rated');
    }
    else {
        updateRating($verdict, $title, $type, $year, $comment, $conn);
    }
}

function assocsGetAll($conn){
    $sql = "SELECT * FROM assocs;";
    $search = mysqli_query($conn, $sql);
    $result_data = mysqli_fetch_all($search, MYSQLI_ASSOC);
    return $result_data;
}

function assocsGetByMovieId($conn, $movieID){
    $sql = "SELECT * FROM assocs WHERE assocsMoviesID = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $movieID);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);
    $verdicts = array();
    while ($row = mysqli_fetch_assoc($result_data)){
        array_push($verdicts, $row);
    }
    return $verdicts;
    mysqli_stmt_close($stmt);
}

function assocsDeleteByMovieIdUsersId($conn, $movieID, $userID){
    $sql = "DELETE FROM assocs WHERE assocsMoviesID = ? and assocsUsersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $movieID, $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $msg_type = 'rating';
    $assocs = assocsGetAll($conn);
    $movies = moviesGetAll($conn, 'moviesID');
    $assocsID = array();
    foreach ($assocs as $row) {
        array_push($assocsID, $row['assocsMoviesID']);
    }
    foreach ($movies as $movie) {
        if (!in_array($movie['moviesID'], $assocsID) === true){
                $sql = "DELETE FROM movies WHERE moviesID = ?;";
                $stmt = mysqli_stmt_init($conn);
                databaseConnectionCheck($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "i", $movie['moviesID']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $msg_type = 'content';
        }
    }
    if ($msg_type === 'content'){
        header('location: ../view_ratings.php?error=content_removed');
        exit();
    }
    if ($msg_type === 'content'){
        header('location: ../view_ratings.php?error=rating_removed');
        exit();
    }
}

// =============== COOKIES DATABASE FUNCTIONS ===============

function cookiesCheckCookie($conn){
    $cookie = $_COOKIE['remember'] ?? null;
    if($cookie && strstr($cookie, ":")){
        $parts = explode(":", $cookie);
        $token_key = $parts[0];
        $token_value = $parts[1];
    }
    else{
        return false;
    }
    $sql = "SELECT * FROM cookies WHERE cookiesKey = ? AND cookiesValue = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token_key, $token_value);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result_data);
    mysqli_stmt_close($stmt);
    return $row;
}

function cookiesSetRemember($conn){
    $expires = time() + ((60*60*24) * 3);
    $token_key = hash('sha256', time());
    $token_value = hash('sha256', 'Yuh@@');
    setcookie('remember', $token_key.':'.$token_value, $expires, '/');
    $sql = "INSERT INTO cookies (cookiesUserID, cookiesKey, cookiesValue) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $_SESSION['usersID'], $token_key, $token_value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function cookiesRemoveCookie($conn){
    unset($_COOKIE['remember']); 
    setcookie('remember', '', -1, '/');
    $sql = "DELETE FROM cookies WHERE cookiesUserID = ?;";
    $stmt = mysqli_stmt_init($conn);
    databaseConnectionCheck($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['usersID']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

