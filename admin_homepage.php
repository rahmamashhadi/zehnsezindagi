<?php
session_start();

include("connection.php");
include("functions.php");

$admin_data = check_admin_login($con);
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
        }
    </style>
</head>
<body>
    <div class="banner">
        <a href="logout.php">Logout</a>
        <a href="profile.php">Create Profile</a>
        <a href="addarticle.php">Add Article</a>
        <a href="addvideo.php">Add Video</a>
        <a href="adddiscount.php">Add Discount</a>
    </div>
    <h1>Home Page</h1>

    Hello.
</body>
</html>