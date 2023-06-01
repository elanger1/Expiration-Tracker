<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" href="css/index_style.css">
    </head>
<?php
include('menu.php');
?>
       
<div class="signupFrm">
    <div class="form">
    <div class="title">
      <h2>Welcome to The Document Tracker!</h2>
    </div>
      <div class="inputContainer">
      <p> This website helps you keep track of all your important documents and sends you email reminders when they are about to expire.</p>
      <p>To get started, please <a href="signup.php">register</a> or <a href="login.php">log in</a> if you already have an account.</p>
      </div>
      <form action="login.php">
        <button type="submit"class="submitBtn">Login</button>
      </form>
      <form action="signup.php">
        <button type="submit"class="submitBtn">Sign Up</button>
      </form>
    </div>

  </div>
</div>

<?php include('footer.html')?>
