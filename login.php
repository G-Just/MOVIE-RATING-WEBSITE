<!DOCTYPE html>
<html lang='en' id='login'>
<?php include 'templates/head.php' ?>

<?php include 'templates/navbar.php' ?>

<div id="form-container">
    <form id="form-itself" action="includes_h\login_h.php" method="post">

        <h1>Login</h1>
        <hr>

        <label id='email'>Email</label>
        <input type="text" name='email'>
        
        <label id='password'>Password</label>
        <input type="password" name='password'>

        <div id='remember-me-container'>
                <label for="remember-me">Keep me logged in</label>
                <input type="checkbox" name="remember" id="remember-me"></input>
            </div>

        <button type="submit" name='submit'>Login</button>

        <div id='login-underlabel-container'>
            <label>Don't have an account? <a href="signup.php">Signup</a></label>
            <div id='remember-me-container'>
                <label for="remember-me">Keep me logged in</label>
                <input type="checkbox" name="remember" id="remember-me"></input>
            </div>
        </div>
        
    </form>
</div>

<?php include 'templates/footer.php' ?>

<?php if (isset($_SESSION['usersID'])){
    header('location: /home.php?error=already_logged_in');
    exit();
}?>