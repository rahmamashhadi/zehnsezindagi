<?php
session_start();
 
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(!empty($email) && !empty($password))
        {
            $user_id = random_num(20);
            $query = "select * from users where email = '$email' limit 1";
            
            $result = mysqli_query($con, $query);
           
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] == $password)
                    {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: homepage.php");
                        die;
                    }
                }
                else{
                    
                }
            }
            echo "Wrong email or password.";
        }else
        {
            echo "Wrong email or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
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

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #9caf88;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #7d9974;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <h1>Login</h1>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <input type="submit" value="Login">

            <br><br>
            <a href="signup.php" class="button-link">Signup</a>
        </form>
    </div>
</body>
</html>
