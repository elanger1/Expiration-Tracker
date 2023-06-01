<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/dashboard_style.css">
    </head>

<?php
include('menu.php');?>

<div class="dashboard_body">
<?php
require_once 'config.php';
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page or handle the case when the email is not set
    header('Location: login.php');
    //exit;
}
$userEmail = $_SESSION['email']; // Store the email in a variable for later use
?>
    <h1>Welcome <?php echo $userEmail; ?>!</h1>
    <p>This is your dashboard.</p>
   
    <script>
    function showList() {
      document.getElementById("list").style.display = "block";
      document.getElementById("add_item_form").style.display = "none";
    }
    
    function showForm() {
      document.getElementById("list").style.display = "none";
      document.getElementById("add_item_form").style.display = "block";
    }
  </script>
  <div class="buttons">
  <button onclick="showList()">Show List</button>
  <button onclick="showForm()">Add Event</button>
  </div>
    <div id='add_item_form' style="display: none;">
        <br>
        <h2>Sign Up</h2>
        <form action="includes/addItem.php" method="post">
            <input type='text' name='eventname'placeholder='Document Name'>
            <br>
            <br>
            <h3 class='eventtype'>Event Type:</h3>
            <?php
            $s1 = "select id, type from event_types";
            $r1 = $conn->query($s1);
            
            while ($row1 = $r1->fetch_assoc()) {
                ?>
                <container class='container'>
                    <input class='eventtype' type='radio' name='eventtype' value='<?= $row1['id']; ?>'><?= $row1['type']; ?></input>
                </container>
                <?php
            }
            ?>
            <br>
            <br>
            <h3 class='eventdate'>Select Time For Reminders:</h3> 
            <select name="days_before">
                <option value="0"></option>
                <?php
                $s2 = "select * from dates";
                $r2 = $conn->query($s2);
                while ($row2 = $r2->fetch_assoc()) {
                    ?>
                    <option class='date'value="<?= $row2['id']; ?>"><?= $row2['days_before']; ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <br>
            <h3 class='exprdate'>Expiration Date:</h3>
            <input type="date" id="event-date" name="event-date">
            <br>
            <br>
            <button type='submit' name='submit'>Add Event</button>
            <br>
            <br>       
        </form>
    </div>
        <div id ="list" style="display:none">
        <?php 
        // Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page or display an error message
    header('Location: login.php');
    exit();
}

// Get the session Email
$sessionEmail = $_SESSION['email'];
        $sql = "SELECT events.*, event_types.type FROM events
        INNER JOIN event_types ON events.event_type_id = event_types.id
        WHERE events.userEmail = '$sessionEmail'";
$result = $conn->query($sql);

// Display the events information
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display event information here
        echo 'Event Name: ' . $row['event_name'] . '<br>';
        echo 'Event Type: ' . $row['type'] . '<br>';
        echo 'Date Expiring: ' . $row['days'] . '<br>';
        echo 'Remind This Many Days Before: ' . $row['date_id'] . '<br>';
        echo '<br>';
    }
} else {
    echo 'No events found.';
}

// Close the database connection
$conn->close();
?>
       </div>
</div>   
</div>
    
<?php include 'footer.html';