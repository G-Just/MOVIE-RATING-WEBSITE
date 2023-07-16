<!DOCTYPE html>
<html lang='en' id='signup'>
<?php include 'templates/head.php' ?>

<?php include 'templates/navbar.php' ?>

<div id="form-container">
    <form id="form-itself" action="includes_h\signup_h.php" method="POST">

        <h1>Signup</h1>
        <hr>

        <label id='name'>Username</label>
        <input type="text" name='username'>

        <label id='email'>Email</label>
        <input type="text" name='email'>

        <label id='password'>Password</label>
        <input type="password" name='password'>

        <label id='confirm_password'>Confirm password</label>
        <input type="password" name='confirm_password'>

        <button type="submit" name='submit' >Signup</button>

        <label>Already have an account? <a href="login.php">LogIn</a></label>
        
    </form>
</div>

<?php include 'templates/footer.php' ?>