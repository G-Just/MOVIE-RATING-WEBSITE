<!DOCTYPE html>
<html lang='en'>
<?php include 'templates/head.php' ?>
<?php if (!isset($_SESSION['usersID'])){
    header('location: /login.php?error=need_to_log_in');
    exit();
}
?>
<?php include 'templates/navbar.php' ?>

<h1 class='empty-message'>Under development !</h1>

<!-- <div id='profile-page-container'>
    <div id='profile-content'>

        <div id='profile-page-general-container'>
            <div id="profile-page-avatar-container">
                <img id='profile-page-avatar' src="media/default_avatar.png" alt="">
                <input type="file" name="image" id="upload-profile-avatar" accept='.jpg, .jpeg, .png'>
            </div>
            <div id="profile-page-avatar-name">
                <h1>
                    <?php // echo $_SESSION['usersUsername']?>
            </h1>
                <h2>Title</h2>
                <p>About</p>
            </div>
        </div>

        <div id='profile-page-details-container'>
            <h1 id='profile-page-details-header'>Change profile details</h1>
            <hr id='profile-page-details-hr'>

            <form class='profile-page-details-forms'>
                <label class='profile-page-details-input-label'>Change username</label>
                <div class="profile-page-details-input-submit">
                    <input class='profile-page-details-input' type="text">
                    <button class='profile-page-details-submit-button' type="submit">Change</button>
                </div>
            </form>

            <form class='profile-page-details-forms'>
                <label class='profile-page-details-input-label'>Change email</label>
                <div class="profile-page-details-input-submit">
                    <input class='profile-page-details-input' type="text">
                    <button class='profile-page-details-submit-button' type="submit">Change</button>
                </div>
            </form>

        </div>

        <div>
        </div>

        <div id='profile-page-movie-list-container'>
            <h1 id='profile-page-movie-list-header'>Rated content</h1>
            <hr>
            <div class='profile-page-movie-block'>
                <h1 class='profile-page-movie-list-title'>Movie name</h1>
                <h2 class='profile-page-movie-list-genre'>Movie genre</h2>
                <h2 class='profile-page-movie-list-rating'>10</h2>
            </div>
            <div class='profile-page-movie-block'>
                <h1 class='profile-page-movie-list-title'>Movie name</h1>
                <h2 class='profile-page-movie-list-genre'>Movie genre</h2>
                <h2 class='profile-page-movie-list-rating'>2</h2>
            </div>
            <div class='profile-page-movie-block'>
                <h1 class='profile-page-movie-list-title'>Movie name</h1>
                <h2 class='profile-page-movie-list-genre'>Movie genre</h2>
                <h2 class='profile-page-movie-list-rating'>5</h2>
            </div>
        </div>

    </div>
</div> -->

<?php include 'templates/footer.php' ?>