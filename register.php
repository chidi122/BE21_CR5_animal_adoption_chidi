<?php
session_start();

if (isset($_SESSION["user"])) { 
    header("Location: home.php");
    exit;
}

if (isset($_SESSION["adm"])) { 
    header("Location: dashboard.php");
    exit;
}

require_once "db_connect.php"; 
require_once "file_upload.php"; 

$error = false;
$fileError = ""; 

function cleanInputs($input) {
    global $connect; 
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

$fname = $lname = $email = $phone_number = $address = $password = ""; 
$fnameError = $lnameError = $emailError = $phoneError = $addressError = $passError = ""; 

if (isset($_POST["sign-up"])) {
    $fname = cleanInputs($_POST["fname"]);
    $lname = cleanInputs($_POST["lname"]);
    $email = cleanInputs($_POST["email"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $address = cleanInputs($_POST["address"]);
    $password = cleanInputs($_POST["password"]);
    $picture = "";

    if (!empty($_FILES['picture']['name'])) {
        $uploadResult = fileUpload($_FILES["picture"]); 
        if ($UploadResult->success) {
            $picture = $UploadResult->filePath;
        } else {
            $error = true;
            $fileError = $UploadResult->message;
        }
    } elseif (!empty($_POST['picture_url'])) {
        $picture_url = cleanInputs($_POST["picture_url"]);
        $picture = $picture_url;
    }

    

    if (!$error) {
        $passwordHashed = hash("sha256", $password); 
        $sql = "INSERT INTO user (first_name, last_name, email, phone_number, address, picture, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssss", $fname, $lname, $email, $phone_number, $address, $picture, $passwordHashed);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>New account has been created</div>";
            } else {
                echo "<div class='alert alert-danger'>Something went wrong, please try again later...</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Something went wrong with the query preparation, please try again later...</div>";
        }
    }
}


?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="text-center">Sign Up</h1>
    <form method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="fname" class="form-label">First name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $fname ?>">
            <span class="text-danger"><?= $fnameError ?></span>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>">
            <span class="text-danger"><?= $lnameError ?></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
            <span class="text-danger"><?= $emailError ?></span>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="<?= $phone_number ?>">
            <span class="text-danger"><?= $phoneError ?></span>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $address ?>">
            <span class="text-danger"><?= $addressError ?></span>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Profile picture</label>
            <input type="file" class="form-control" id="picture" name="picture">
            <span class="text-muted">Or enter URL:</span>
            <input type="text" class="form-control mt-2" id="picture_url" name="picture_url" placeholder="Enter URL">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="text-danger"><?= $passError ?></span>
        </div>
        <button name="sign-up" type="submit" class="btn btn-primary">Create account</button>
        <span>Already have an account? <a href="login.php">Sign in here</a></span>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>