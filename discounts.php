<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$sql_discounts = "SELECT title, link FROM discounts";
$result_discounts = $con->query($sql_discounts);

if ($result_discounts === false) {
    echo "Error in query: " . $con->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    <title>Awareness</title>
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

        .discounts-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .discounts {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: hidden;
            max-height: 200px;
            transition: max-height 0.3s ease;
        }

        .discounts.expanded {
            max-height: 1000px;
        }

        .discounts h2 {
            color: #9caf88;
        }

        .discounts p {
            margin: 10px 0;
        }

        .read-more {
            color: #9caf88;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
    <div class="banner">
        <a href="appointments.php" class="button-link">Book Appointment</a>
        <a href="homepage.php" class="button-link">Home Page</a>
    </div>

    <h1>Discounts</h1>

    <div class="discounts-container">
        <?php
        if ($result_discounts && $result_discounts->num_rows > 0) {
            while($row = $result_discounts->fetch_assoc()) {
                echo "<div class='discounts'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<a href='".$row['link']."' class='button-link' target='_blank'>Read More</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No discounts found.</p>";
        }
        ?>
    </div>
</body>
</html>