<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Website</title>
    <style>
        body {
            background-color: #f5f5f5; 
            color: #333;
            font-family: Arial, sans-serif;
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
            text-align: center;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
            padding: 0 10px;
            flex-wrap: wrap;
        }

        .stat {
            flex: 1;
            min-width: 150px; /* Ensures items wrap on smaller screens */
            background-color: #fff;
            padding: 20px;
            border: 2px solid #9caf88;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5em;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .small-text {
            font-size: 0.75em;
            color: #666;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="banner">
        <a href="logout.php">Logout</a>
        <a href="profile.php">Create Profile</a>
        <a href="awareness.php">Awareness</a>
        <a href="appointments.php">Book Appointment</a>
        <a href="discounts.php">Discounts</a>
    </div>
    <h1>Home Page</h1>

    <div class="stats-container">
        <div class="stat">
            <span class="small-text">Have experienced mental health challenges:</span>
            <span id="stat1">0%</span>
        </div>

        <div class="stat">
            <span class="small-text">Sought professional help:</span>
            <span id="stat2">0%</span>
        </div>

        <div class="stat">
            <span class="small-text">Find resources difficult to access:</span>
            <span id="stat3">0%</span>
        </div>
    </div>

    <script>
        function animateValue(id, start, end, duration) {
            let obj = document.getElementById(id);
            let range = end - start;
            let current = start;
            let increment = end > start ? 1 : -1;
            let stepTime = Math.abs(Math.floor(duration / range));
            let timer = setInterval(function() {
                current += increment;
                obj.innerHTML = current + "%";
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        window.onload = function() {
            animateValue("stat1", 0, 58, 2000);  // 58%
            animateValue("stat2", 0, 6, 2000);   // 6%
            animateValue("stat3", 0, 76, 2000);  // 76%
        };
    </script>
</body>
</html>
