<?php
session_start();

include("connection.php");
include("functions.php");

$admin_data = check_helper_login($con);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <style>
        body {
            background-color: #f5f5f5; 
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .banner {
            background-color: #9caf88;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .banner a {
            padding: 10px 20px;
            background-color: #fff;
            color: #9caf88; 
            text-decoration: none;
            border: 2px solid #9caf88;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .banner a:hover {
            background-color: #7d9974;
            color: #fff;
        }

        h1 {
            color: #9caf88;
        }

        #calendar {
            max-width: 80%;
            height: 500px; 
            margin: 20px auto;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .fc-day:hover {
            cursor: pointer;
        }

button[type="submit"] {
    background-color: #9caf88;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #7d9974;
}

    </style>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            document.getElementById('selected-date').innerText = info.dateStr;
            document.getElementById('date-input').value = info.dateStr;
            document.getElementById('timeModal').style.display = 'block';
        },
        events: [
            <?php
            $result = mysqli_query($con, "SELECT * FROM appointments WHERE helper_id = '$admin_data[id]'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "{
                    id: " . $row['id'] . ",
                    title: 'Appointment',
                    start: '" . $row['appointment_time'] . "',
                    backgroundColor: " . ($row['user_id'] == $user_id ? "'#9caf88'" : "'#ccc'") . "
                },";
            }
            ?>
        ],
        eventClick: function(info) {
            var isTherapist = <?php echo isset($admin_data) ? 'true' : 'false'; ?>;
            if (confirm('Do you want to delete this appointment?')) {
                if (isTherapist || info.event.backgroundColor == '#9caf88') {
                    $.ajax({
                        url: 'delete_appointment.php',
                        type: 'POST',
                        data: { event_id: info.event.id },
                        success: function(response) {
                            if (response == 'success') {
                                info.event.remove(); 
                                alert('Appointment deleted successfully.');
                            } else {
                                alert('Failed to delete appointment. Server response: ' + response);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('AJAX request failed: ' + textStatus + ', ' + errorThrown);
                        }
                    });
                }
            }
        }
    });
    calendar.render();
});

    </script>
</head>
<body>
    <div class="banner">
        <a href="helper_homepage.php">Home</a>
    </div>
    <div id='calendar'></div>

</body>
</html>