<?php
session_start();
require_once '../config.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page or handle the case when the email is not set
    // For example: header('Location: login.php');
    exit;
}
$userEmail = $_SESSION['email']; // Store the email in a variable for later use
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the values from the form
    $eventName = $_POST['eventname'];
    $eventType = $_POST['eventtype'];
    $days = $_POST['days_before'];
    $eventDate = $_POST['event-date'];
    //$userEmail = $_SESSION['email'];
    
    // Insert the event information into the database
    $query = "INSERT INTO events (event_name, event_type_id, days, date_id, userEmail) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sisis", $eventName, $eventType, $eventDate, $days, $userEmail);
    
    if ($stmt->execute()) {

    $email = $userEmail;
    $subject = "New Event Added";
    $message = "You have scheduled $eventName. \nScheduled For:  
            $eventDate. \nReminder Scheduled for $days Days Before. \nYou can view you events by logging in";
    
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
    
    
    header("Location: ../dashboard.php");

    } else {
        // Failed to add the event
        echo "Error adding event: " . $stmt->error;
    }
} else {
    // Form not submitted
    echo "Form not submitted.";
}
