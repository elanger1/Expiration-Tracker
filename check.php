<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "smart_expenses_management");

if(mysqli_connect_errno()){
    echo "Unable to connect".mysqli_connect_error();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$current_date = date("YYYY-mm-dd");

$emails = array();
$result = mysqli_query($con, "SELECT email FROM reminder WHERE reminder_date = '$current_date'");
while ($row = mysqli_fetch_assoc($result)) {
    $emails[] = $row['email'];
}

if(count($emails) > 0)
{
    $mail = new PHPMailer(true); //create instance of phpmailer

    $mail -> isSMTP();
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'myemail@gmail.com';
    $mail -> Password = '*mypassword*';
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;

    $mail -> setFrom('myemail@gmail.com');
    
    foreach($emails as $email) {
        $mail -> addAddress($email);
    }

    $mail -> isHTML(true);

    $mail -> Subject = "Reminder!";
    $mail -> Body = "test";

    $mail -> Send();

}