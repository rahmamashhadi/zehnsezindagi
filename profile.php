<?php
session_start();
 
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $DOB = $_POST['DOB'];
    $city = $_POST['city'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    if (!empty($DOB) && !empty($city) && !empty($phone_number)) {
        $query = "UPDATE users SET DOB = '$DOB', city = '$city', phone_number = '$phone_number' WHERE email = '$email'";
        mysqli_query($con, $query);
        header("Location: homepage.php");
        die;
    } else {
        echo "Please fill in all information.";
    }
} else {
    $email = $user_data['email'];
    $query = "SELECT DOB, city, phone_number FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_profile_data = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
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
    <h1>Profile</h1>

    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
        </div>

        <div>
            <label for="DOB">Date of Birth</label>
            <input type="date" id="DOB" name="DOB" value="<?php echo htmlspecialchars($user_profile_data['DOB']); ?>">
        </div>

        <div>
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user_profile_data['city']); ?>">
        </div>

        <div>
            <label for="phone_number">Phone Number</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user_profile_data['phone_number']); ?>">
        </div>

        <button type="submit">Save</button>
        <br><br>
        <a href="homepage.php" class="button-link">Back to Home Page</a>
    </form>
</body>
</html>
