<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$sql_articles = "SELECT title, link FROM articles";
$result_articles = $con->query($sql_articles);

if ($result_articles === false) {
    echo "Error in query: " . $con->error;
}

// Fetch video data from the database
$sql_videos = "SELECT title, link FROM videos";
$result_videos = $con->query($sql_videos);

if ($result_videos === false) {
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
        .carousel-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .video-item {
            padding: 10px;
            text-align: center;
        }

        .video-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .video-item h3 {
            margin-top: 10px;
            color: #9caf88;
        }

        .slick-prev, .slick-next {
            font-size: 20px;
            color: #9caf88;
        }

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

        .article-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .article {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: hidden;
            max-height: 200px;
            transition: max-height 0.3s ease;
        }

        .article.expanded {
            max-height: 1000px;
        }

        .article h2 {
            color: #9caf88;
        }

        .article p {
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
    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                infinite: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
</head>
<body>
    <div class="banner">
        <a href="appointments.php" class="button-link">Book Appointment</a>
        <a href="homepage.php" class="button-link">Home Page</a>
    </div>

    <h1>Articles</h1>

    <div class="article-container">
        <?php
        if ($result_articles && $result_articles->num_rows > 0) {
            while($row = $result_articles->fetch_assoc()) {
                echo "<div class='article'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<a href='".$row['link']."' class='button-link' target='_blank'>Read More</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No articles found.</p>";
        }
        ?>
    </div>

    <h1>Videos</h1>

    <div class="carousel-container">
        <div class="carousel">
            <?php
            if ($result_videos && $result_videos->num_rows > 0) {
                while($row = $result_videos->fetch_assoc()) {
                    $video_id = parse_url($row['link'], PHP_URL_QUERY);
                    parse_str($video_id, $video_params);
                    $thumbnail_url = "https://img.youtube.com/vi/" . $video_params['v'] . "/hqdefault.jpg";
                    echo "<div class='video-item'>";
                    echo "<a href='" . htmlspecialchars($row['link']) . "' target='_blank'>";
                    echo "<img src='" . htmlspecialchars($thumbnail_url) . "' alt='" . htmlspecialchars($row['title']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No videos found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
