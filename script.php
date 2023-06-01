<?php
require_once 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Calculate the date (date minus days) for today
$today = date('Y-m-d');
echo $today . "<br>";
// Query the events table
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

// Iterate through the events and check the calculated date against today's date
while ($row = mysqli_fetch_assoc($result)) {
    $eventId = $row['id'];
    $eventName = $row['event_name'];
    echo $eventName . "<br>";
    $eventDate = $row['days'];
    echo $eventDate . "<br>";
    $eventDateID = $row['date_id'];
    echo $eventDateID . "<br>";
    $userEmail = $row['userEmail'];
    echo $userEmail . "<br>";
    
    $eventDateTimestamp = strtotime($eventDate);
    $calculatedTimestamp = strtotime("-" . $eventDateID . " days", $eventDateTimestamp);
    $calculatedDate = date('Y-m-d', $calculatedTimestamp);

    // Calculate the date (date minus days) for the event
    //$calculatedDate = date('Y-m-d', strtotime("-" . $eventDateID . " days", $eventDate));
    echo $calculatedDate . "<br>";
    
    // Compare the calculated date with today's date
    if ($calculatedDate == $today) {
    $email = $userEmail;
    $subject = "Reminder!";
    $message = "This is your reminder that your $eventName expires/is scheduled for $eventDate which is in $eventDateID days!";
    
    $mail = new PHPMailer(true);
    $mail ->isSMTP();
    $mail ->Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'expirenotice@gmail.com';
    $mail-> Password = 'rwkqofwburcllclh';
    $mail->Port = 465;
    $mail -> SMTPSecure = 'ssl';
    $mail ->isHTML(true);
    $mail ->setFrom('expirenotice@gmail.com', 'Expiration Tracker');
    $mail ->addAddress($email);
    $mail->Subject = ($subject);
    $mail ->Body = $message;
    $mail->send();
        // Event added successfully
    }
}

// Close the database connection
mysqli_close($conn);
