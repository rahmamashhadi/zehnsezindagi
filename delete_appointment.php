<?php
session_start();
include("connection.php");
include("functions.php");

if (isset($_SESSION['user_id']) || isset($_SESSION['helper_id'])) {
   
    $is_admin = isset($_SESSION['helper_id']);
    
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    if (isset($_POST['event_id'])) {
        $event_id = intval($_POST['event_id']);
    
        if ($is_admin) {
            $stmt = $con->prepare("DELETE FROM appointments WHERE id = ?");
            $stmt->bind_param("i", $event_id);
        } else {
            $stmt = $con->prepare("DELETE FROM appointments WHERE id = ? AND id = ?");
            $stmt->bind_param("ii", $event_id, $user_id);
        }
    
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo 'success';
            } else {
                echo 'No appointment found or you do not have permission to delete it.';
            }
        } else {
            echo 'Error: ' . $stmt->error;
        }
    
        $stmt->close();
    } else {
        echo 'Invalid request.';
    }
    
    $con->close(); 
}
else{
    echo 'Unauthorized';
    exit;
}


?>
