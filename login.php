<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" href="css/login_style.css">
    </head>

<?php
include('menu.php');
require_once 'config.php';
?>
<div class="signupFrm">
    <form action="login.php" method="post" class="form">  
        <h1 class="title">Login</h1>
        <div class ="inputContainer">
        <label for="email" class="label">Email:</label>
        <input type="email" name="email" required class="input">
        </div>
        <div class ="inputContainer">
        <label for="password" class="label">Password:</label>
        <input type="password" name="password" required class="input">
        </div>
        <button type="submit"class="submitBtn">Login</button>
    </form>
</div>
<?php
// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if email and password match
    //$sql = "SELECT id, email FROM users WHERE email = ? AND password = ?";
    $sql = "SELECT * FROM users WHERE email = '$email'";
// Execute SQL statement and retrieve user data
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_assoc($result);

      // Check if user exists and password is correct
      if ($user && password_verify($password, $user['password'])) {
        echo "Login Successful";
        session_start();
        //set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        
        header('Location: script.php');
        exit();
    } else {
        // If email and password don't match, redirect back to login page with error message
        header('Location: index.php?error=1');
        exit();
    }

}
?>
<?php
include 'footer.html';
