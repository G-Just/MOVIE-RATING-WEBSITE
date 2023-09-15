<!DOCTYPE html>
<html lang='en' id='signup'>
<?php include 'templates/head.php' ?>

<?php include 'templates/navbar.php' ?>

<div id="form-container">
    <form id="form-itself" action="includes_h\signup_h.php" method="POST">

        <h1 id='form-header'>Signup</h1>
        <hr>

        <label class='input-labels' id='name'>Username</label>
        <input class='input-fields' type="text" name='username'>

        <label class='input-labels' id='email'>Email</label>
        <input class='input-fields' type="text" name='email'>

        <label class='input-labels' id='password'>Password</label>
        <input class='input-fields' type="password" name='password'>

        <label class='input-labels' id='confirm_password'>Confirm password</label>
        <input class='input-fields' type="password" name='confirm_password'>

        <button class='form-submit-buttons signup-button' type="submit" name='submit'>Signup</button>

        <div class='form-underlabel-container'>
            <label>Already have an account ? <a href="login.php">Login</a></label>
        </div>

    </form>
</div>

<?php include 'templates/footer.php' ?>