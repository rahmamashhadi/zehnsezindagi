<?php
session_start();

include("connection.php");
include("functions.php");

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
            background-color: #9caf88;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding-right: 20%;
        }

        .button-link {
            display: block;
            padding: 20px 40px;
            background-color: #fff;
            color: #9caf88;
            text-decoration: none;
            border: 2px solid #fff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            margin: 10px 0;
            font-size: 1.2em;
            text-align: center;
            margin-right: 80px;
        }

        .button-link:hover {
            background-color: #7d9974;
            color: #fff;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <h1>What's Your Role?</h1>
    <a href="signup.php" class="button-link" >User <style></style></a>
    <a href="helper_login.php" class="button-link">Helper</a>
    <a href="admin_login.php" class="button-link">Admin</a>
</body>
</html>
