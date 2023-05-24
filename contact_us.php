<?php
include "menu.php";
?>

<!doctype html>
<html>
    <head>
        <title>Contact Us</title>
        <link rel="stylesheet" href="css/contact_us.css"/>
    </head>
    <body>
        <form action ="mail.php" method="post">
            <input type="text"name="name"placeholder="Name"autocomplete="off">
            <input type="email"name="email"placeholder="Email"autocomplete="off">
            <input type="text"name="subject"placeholder="Subject"autocomplete="off">
            <textarea name="message"placeholder="message..."></textarea>
            <button type="submit" name="send">Send</button>
        </form>
    </body>
</html>

<?php
include"footer.html";





