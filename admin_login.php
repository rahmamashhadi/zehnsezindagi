<?php
session_start();
 
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $admin_name = $_POST['admin_name'];
        $password = $_POST['password'];
        
        if(!empty($admin_name) && !empty($password))
        {
            $admin_name = mysqli_real_escape_string($con, $admin_name);
            $password = mysqli_real_escape_string($con, $password);
            
            $query = "SELECT * FROM admin WHERE admin_name = '$admin_name' LIMIT 1";
            
            $result = mysqli_query($con, $query);
           
            if($result && mysqli_num_rows($result) > 0)
            {
                $admin_data = mysqli_fetch_assoc($result);
                
                if($admin_data['password'] == $password)
                {
                    $_SESSION['admin_name'] = $admin_data['admin_name'];
                    header("Location: admin_homepage.php");
                    die;
                }
            }
            
            echo "Wrong email or password.";
        }
        else
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
                    <label for="admin_name">Admin Name</label>
                    <input type="text" id="admin_name" name="admin_name" required>
                </div>
    
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
    
                <input type="submit" value="Login">
    
                <br><br>
            </form>
        </div>
    </body>
    </html>