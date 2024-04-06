<?php
session_start(); 

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
        $layout .= "<div class='col'><div class='card mb-4' style='width: 18rem;'>
        <img src='{$value["picture"]}' class='card-img-top' alt='{$value["name"]}'>
        <div class='card-body'>
          <h5 class='card-title'>{$value["name"]}</h5>
          <p class='card-text'>Location: {$value["location"]}</p>
          <p class='card-text'>Description: {$value["description"]}</p>
          <p class='card-text'>Size: {$value["size"]} - Age: {$value["age"]} years - Vaccinated: $vaccinatedText</p>
          <p class='card-text'>Breed: {$value["breed"]} - Availability: {$value["availability"]}</p>
          <a href='details.php?id={$value["id"]}' class='btn btn-primary'>Details</a>
          <!-- Adoption Form -->
          <form method='POST' action='adopt.php' onsubmit='showAdoptionSuccess()'>
              <input type='hidden' name='pet_id' value='{$value["id"]}'>
              <button type='submit' class='btn btn-success'>Take me home</button>
          </form>
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
    <title>Animal Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
    function showAdoptionSuccess() {
        alert("Successfully adopted");
    }
    </script>
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2022/12/06/13/59/dog-7639052_1280.jpg'); 
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="senior.php">Senior Animals</a>
                </li>
                <?php if(isset($_SESSION["user"]) || isset($_SESSION["adm"])): ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $_SESSION['user_pic'] ?? 'https://cdn.pixabay.com/photo/2023/11/10/08/06/dog-8378909_1280.jpg' ?>" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                            <?= $_SESSION['user_email'] ?? 'fabian@yahoo.com' ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
<div class="row row-cols-3">
        <?= $layout ?>
    </div>
</div>

<footer class="bg-dark text-white text-center p-3">
    <p>© 2023 Chidi&Sons Animal Shelter. All rights reserved.</p>
    <p>Email us at: <a href="mailto:info@chidisons.com" class="text-white">info@chidisons.com</a></p>
    <!-- the email address is responsive  -->
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
