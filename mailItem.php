<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(isset($_POST['send'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    
    $mail = new PHPMailer(true);
    $mail ->isSMTP();
    $mail ->Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'expirenotice@gmail.com';
    $mail-> Password = 'rwkqofwburcllclh';
    $mail->Port = 465;
    $mail -> SMTPSecure = 'ssl';
    $mail ->isHTML(true);
    $mail ->setFrom($email, $name);
    $mail ->addAddress('expirenotice@gmail.com');
    $mail->Subject = ("$email($subject)");
    $mail ->Body = $message;
    $mail->send();
    
    header("Location: response.php");
}

