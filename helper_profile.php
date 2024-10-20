<?php
session_start();

include("connection.php");
include("functions.php");

$helper_data = check_helper_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $charges = mysqli_real_escape_string($con, $_POST['charges']);

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $image = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
        $image_query = ", profile_picture = '$image'";
    } else {
        $image_query = "";
    }

    if (!empty($name) && !empty($city) && !empty($phone_number) && !empty($description) && !empty($charges)) {

        $email = $helper_data['email'];
        $query = "UPDATE helpers SET name = '$name', city = '$city', phone_number = '$phone_number', description = '$description', charges = '$charges' $image_query WHERE email = '$email'";
        mysqli_query($con, $query);
        header("Location: helper_homepage.php");
        die;
    } else {
        echo "Please fill in all information.";
    }
} else {

    $email = $helper_data['email'];
    $query = "SELECT name, city, phone_number, description, charges FROM helpers WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $helper_profile_data = mysqli_fetch_assoc($result);
    } else {
        echo "Helper not found.";
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

    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($helper_data['email']); ?>" readonly>
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($helper_profile_data['name']); ?>">
        </div>

        <div>
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($helper_profile_data['city']); ?>">
        </div>

        <div>
            <label for="phone_number">Phone Number</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($helper_profile_data['phone_number']); ?>">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($helper_profile_data['description']); ?></textarea>
        </div>

        <div>
            <label for="charges">Charges (PKR per hour)</label>
            <input type="number" id="charges" name="charges" value="<?php echo htmlspecialchars($helper_profile_data['charges']); ?>">
        </div>

        <div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        </div>

        <button type="submit">Save</button>
        <br><br>
        <a href="helper_homepage.php" class="button-link">Back to Home Page</a>
    </form>
</body>
</html>

