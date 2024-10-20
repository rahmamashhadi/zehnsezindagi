<?php
session_start();

include("connection.php");
include("functions.php");

// Check if user is logged in
$user_data = check_login($con);

// Ensure POST data is set
if (isset($_POST['date']) && isset($_POST['time']) && isset($_POST['helper_id'])) {
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $helper_id = mysqli_real_escape_string($con, $_POST['helper_id']);
    $user_id = $user_data['user_id'];

    // Combine date and time into a single datetime string
    $appointment_time = $date . ' ' . $time;

    // Check if the appointment slot is already taken
    $query = "SELECT * FROM appointments WHERE helper_id = '$helper_id' AND appointment_time = '$appointment_time'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Slot is already taken
        echo "This time slot is already booked.";
    } else {
        // Verify that user_id and helper_id exist in their respective tables
        $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $helper_query = "SELECT * FROM helpers WHERE id = '$helper_id'";
        
        if (mysqli_num_rows(mysqli_query($con, $user_query)) > 0 && mysqli_num_rows(mysqli_query($con, $helper_query)) > 0) {
            // Insert new appointment
            $query = "INSERT INTO appointments (user_id, helper_id, appointment_time) VALUES ('$user_id', '$helper_id', '$appointment_time')";
            if (mysqli_query($con, $query)) {
                echo "Appointment booked successfully.";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "User or Helper not found.";
        }
    }
} else {
    echo "Required data missing.";
}
?>