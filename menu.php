
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu_style.css">
</head>
    <?php
    session_start();
    
?>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php 
        if (isset($_SESSION['user_id'])){
            echo "<li><a href='dashboard.php'>Dashboard</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";
        }
        else{
            echo "<li><a href='signup.php'>Sign Up</a></li>";
            echo "<li><a href='login.php'>Login</a></li>";
            echo "<li><a href='contact_us.php'>Contact Us</a></li>";
        }
        ?>
    </ul>
</nav>
</body>
