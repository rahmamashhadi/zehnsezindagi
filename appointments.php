<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$query = "SELECT id, name, city, phone_number, email, description, charges, profile_picture FROM helpers";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapists</title>
    <style>
        body {
            background-color: #f5f5f5; 
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #9caf88;
            text-align: center;
        }

        .therapist-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }

        .therapist {
            background-color: #fff;
            padding: 20px;
            border: 2px solid #9caf88;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .therapist img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }

        .therapist-info {
            text-align: left;
            flex: 1;
        }

        .therapist h2 {
            margin: 0;
            color: #333;
        }

        .therapist p {
            color: #666;
            margin: 10px 0;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #9caf88;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #7d9974;
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
    </style>
</head>
<body>
    <div class="banner">
        <a href="homepage.php" class="button-link">Home Page</a>
        <a href="discounts.php" class="button-link">Discounts</a>
    </div>
    
    <h1>Therapists</h1>

    <div class="therapist-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="therapist">';

                if (!empty($row['profile_picture'])) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_picture']) . '" alt="Profile Picture">';
                } else {
                    echo '<img src="default-profile.png" alt="Default Profile Picture">';
                }
                
                echo '<div class="therapist-info">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>City: ' . $row['city'] . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>Charges: ' . $row['charges'] . ' PKR per hour</p>';
                echo '<p>Contact Number: ' . $row['phone_number'] . '</p>';
                echo '<p>Email: ' . $row['email'] . '</p>';

                echo '<a href="calendar.php?helper_id=' . $row['id'] . '" class="btn">Book Appointment</a>';
                
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No therapists available.</p>';
        }
        ?>
    </div>
</body>
</html>
