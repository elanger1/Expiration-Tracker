<?php
session_start();
require_once '../config.php';

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
        // Event added successfully
        header('Location: ../dashboard.php');
    } else {
        // Failed to add the event
        echo "Error adding event: " . $stmt->error;
    }
} else {
    // Form not submitted
    echo "Form not submitted.";
}
