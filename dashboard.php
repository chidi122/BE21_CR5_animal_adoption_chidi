<?php
session_start();


if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit;
}

require_once "db_connect.php";

$sql = "SELECT * FROM `animal`";
$result = mysqli_query($conn, $sql);
$layout = "";

if (mysqli_num_rows($result) == 0) {
    $layout = "No animals found.";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    foreach ($rows as $value) {
        $vaccinatedText = $value['vaccinated'] ? 'Yes' : 'No';
        $layout .= "<div class='mb-4'><div class='card' style='width: 18rem;'>
        <img src='{$value["picture"]}' class='card-img-top' alt='{$value["name"]}'>
        <div class='card-body'>
          <h5 class='card-title'>{$value["name"]}</h5>
          <p class='card-text'>Location: {$value["location"]}</p>
          <p class='card-text'>Description: {$value["description"]}</p>
          <p class='card-text'>Size: {$value["size"]} - Age: {$value["age"]} years - Vaccinated: {$vaccinatedText}</p>
          <p class='card-text'>Breed: {$value["breed"]} - Availability: {$value["availability"]}</p>
          
          <a href='create.php?id={$value["id"]}' class='btn btn-primary'>create</a>
          <a href='update.php?id={$value["id"]}' class='btn btn-primary'>update</a>
          <a href='delete.php?id={$value["id"]}' class='btn btn-danger'>delete</a>
        </div>
      </div></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2023/03/02/14/46/pit-bull-7825554_1280.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Chidi&Sons</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Pets Available</a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
    <h1 class="mb-4">Animal Adoption Dashboard</h1>
    <div class="row row-cols-3">
        <?= $layout ?>
    </div>
</div>

<footer class="bg-dark text-white text-center p-3">
    <p>© 2023 Chidi&Sons Animal Shelter. All rights reserved.</p>
    <p>Email us at: <a href="mailto:info@chidisons.com" class="text-white">info@chidisons.com</a></p>
    <!-- the email address is responsive  -->
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
