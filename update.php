<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["adm"])) {
    header("Location: login.php"); 
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php"); 
    exit;
}

$animalId = $_GET['id'];

$sql = "SELECT * FROM animal WHERE id = $animalId";
$result = mysqli_query($conn, $sql);
$animalData = mysqli_fetch_assoc($result);

if (!$animalData) {
    echo "Animal not found.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $picture = $_POST['picture'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0; 
    $breed = $_POST['breed'];
    $availability = $_POST['availability'];
    
    $updateSql = "UPDATE animal SET
                    name = '$name',
                    picture = '$picture',
                    location = '$location',
                    description = '$description',
                    size = '$size',
                    age = '$age',
                    vaccinated = '$vaccinated',
                    breed = '$breed',
                    availability = '$availability'
                  WHERE id = $animalId";
    $updateResult = mysqli_query($conn, $updateSql);
    if ($updateResult) {
        
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating animal: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Animal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
body {
            background-image: url('https://cdn.pixabay.com/photo/2018/03/31/06/31/dog-3277414_1280.jpg');
            background-size: cover;
            background-attachment: fixed;
            margin: 10px;
        }
</style>
<body>
    <div class="container mt-5">
        <h2>Update Animal</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $animalData['name']; ?>">
            </div>
            <div class="form-group">
                <label for="picture">Picture URL:</label>
                <input type="text" class="form-control" id="picture" name="picture" value="<?php echo $animalData['picture']; ?>">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $animalData['location']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $animalData['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" class="form-control" id="size" name="size" value="<?php echo $animalData['size']; ?>">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" name="age" value="<?php echo $animalData['age']; ?>">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="vaccinated" name="vaccinated" <?php echo $animalData['vaccinated'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="vaccinated">Vaccinated</label>
                </div>
            </div>
            <div class="form-group">
                <label for="breed">Breed:</label>
                <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $animalData['breed']; ?>">
            </div>
            <div class="form-group">
                <label for="availability">availability:</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $animalData['availability']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a> 
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



