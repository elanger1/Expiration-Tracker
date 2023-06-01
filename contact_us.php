<!doctype html>
<html>
    <head>
        <title>Contact Us</title>
        <link rel="stylesheet" href="css/login_style.css"/>
    </head>
<?php
include "menu.php";
?>
    <body>
        <div class="signupFrm">
        <form class="form"action ="mail.php" method="post">
            <h1 class="title">Contact Us</h1>
            <div class="inputContainer">
            <label for="name" class="label">Name:</label>        
            <input class="input"type="text"name="name"autocomplete="off">
            </div>
            <div class="inputContainer">
            <label for="email" class="label">Email:</label>  
            <input class="input" type="email"name="email"autocomplete="off">
            </div>
            <div class="inputContainer">
            <label for="subject" class="label">Subject:</label>
            <input class="input" type="text"name="subject"autocomplete="off">
            </div>
            <div class="inputContainer">
            <label for="message" class="label">Message:</label>               
            <textarea class="input" name="message"></textarea>
            </div>
            <button type="submit" name="send"class="submitBtn">Send</button>
        </form>
        </div>
    </body>

<?php
include"footer.html";





