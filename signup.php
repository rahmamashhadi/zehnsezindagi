<?php
session_start();
 
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $password = $_POST['password'];
        $password_conf = $_POST['password_conf'];
        $email = $_POST['email'];
        $name = $_POST['name'];

        if ($_POST["password"] !== $_POST["password_conf"]) {
            die("Passwords must match");
        }
        else if (!empty($email) && !empty($name) && !empty($password))
        {
            $user_id = random_num(20);
            $query = "insert into users (user_id, password, email, name) values ('$user_id', '$password', '$email', '$name')";
            
            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        }else
        {
            echo "Please enter valid information.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Page Sign Up</title>
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #fff;
            color: #9caf88;
            text-decoration: none;
            border: 2px solid #9caf88;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .button-link:hover {
            background-color: #7d9974;
            color: #fff;
        }

        h1 {
            color: #9caf88;
        }

        button {
            padding: 10px 20px;
            background-color: #9caf88;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #7d9974;
        }
    </style>
</head>
<body>
    <h1>Sign Up</h1>

    <form method="post">

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="password_conf">Password Confirmation</label>
            <input type="password" id="password_conf" name="password_conf">
        </div>

        <button>Sign Up</button>
        <br><br>
        <a href="login.php" class="button-link">Login</a>
    </form>
</body>
</html>
