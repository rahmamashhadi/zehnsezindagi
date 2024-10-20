<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $helper_id = $_SESSION['helper_id'];
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_start = $_POST['event_start'];
    $event_end = $_POST['event_end'];

    if (!empty($helper_id) && !empty($event_title) && !empty($event_start) && !empty($event_end)) {
        $query = "INSERT INTO helper_schedule (helper_id, event_title, event_description, event_start, event_end) VALUES ('$helper_id', '$event_title', '$event_description', '$event_start', '$event_end')";
        mysqli_query($con, $query);

        header("Location: calendar.php");
        die;
    } else {
        echo "Please fill all required fields.";
    }
}
?>