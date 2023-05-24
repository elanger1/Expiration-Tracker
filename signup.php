<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="css/login_style.css">
    </head>

<?php
include 'menu.php';
require_once 'config.php';
?>
    <div class='signupFrm'>
        <form method="post" class="form">
        <h1 class="title">Sign Up</h1>
            <div class="inputContainer">
                <label for="username" class="label">Name:</label>
                <input type="text" name="username" required class="input">
            </div>
            <div class="inputContainer">
                <label for="email"class="label">Email:</label>
                <input type="email" name="email" required class="input">
            </div>
            <div class="inputContainer">
                <label for="password"class="label">Password:</label>
                <input type="password" name="password" required class="input">
            </div>
            <div class="inputContainer">
                <label for="phone"class="label">Phone:</label>
                <input type="tel" name="phone" required class="input">
            </div>
                <button type="submit"class="submitBtn">Sign Up</button>
            </form>
    </div>
        <?php
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve user input
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];

        // Prepare SQL statement to insert user data
        $sql = "INSERT INTO users (username, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";

        // Execute SQL statement
        if (mysqli_query($conn, $sql)) {
            echo 'User created successfully';
        } else {
            echo 'Error creating user: ' . mysqli_error($conn);
        }
        }

        // Close database connection
        mysqli_close($conn);
  ?>

<?php
include 'footer.html';
?>
    </section>