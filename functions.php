<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: login.php");
    die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i=0; $i < $len; $i++){
        $text .= rand(0,9);
    }

    return $text;
}

function check_admin_login($con)
{
    if(isset($_SESSION['admin_name']))
    {
        $admin_name = $_SESSION['admin_name'];
        $query = "SELECT * FROM admin WHERE admin_name = '$admin_name' LIMIT 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $admin_data = mysqli_fetch_assoc($result);
            return $admin_data;
        }
    }

    header("Location: admin_login.php");
    die;
}

function check_helper_login($con)
{
    if(isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM helpers WHERE id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $helper_data = mysqli_fetch_assoc($result);
            return $helper_data;
        }
    }

    header("Location: helper_login.php");
    die;
}