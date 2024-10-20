<?php
session_start();

include("connection.php");
include("functions.php");

$admin_data = check_admin_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $title = $_POST['title'];
    $link = $_POST['link'];

    if (!empty($link) && !empty($title))
    {
        $query = "insert into discounts (title, link) values ('$title', '$link')";
        
        mysqli_query($con, $query);

        header("Location: admin_homepage.php");
        die;
    }else
    {
        echo "Please enter information.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
</head>
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
<body>
<div class="banner">
        <a href="admin_homepage.php">Home</a>
        <a href="addarticle.php">Add Article</a>
        <a href="addvideo.php">Add Video</a>
    </div>
    <h1>Add Discount</h1>
    
    <form method="post">

        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title">
        </div>

        <div>
            <label for="link">Link</label>
            <input type="url" id="link" name="link">
        </div>
        <button>Add Discount</button>
        <br><br>
    </form>
</body>
</html>