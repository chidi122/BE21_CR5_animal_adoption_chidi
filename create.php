<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit;
}

$name = $description = $location = $picture = $size = $age = $vaccinated = $breed = $availability = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $picture = trim($_POST['picture']); 
    $size = trim($_POST['size']);
    $age = trim($_POST['age']);
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $breed = trim($_POST['breed']);
    $availability = trim($_POST['availability']); 

    if (empty($name)) $errors[] = "Name is required";
    if (empty($description)) $errors[] = "Description is required";
    if (empty($location)) $errors[] = "Location is required";

    if (empty($errors)) {
        
        $sql = "INSERT INTO animal (name, description, location, picture, size, age, vaccinated, breed, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssiiss", $name, $description, $location, $picture, $size, $age, $vaccinated, $breed, $availability);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Error creating animal: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Animal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
body {
            background-image: url('https://cdn.pixabay.com/photo/2021/12/07/18/30/cat-6853848_1280.jpg');
            background-size: cover;
            background-attachment: fixed;
            margin: 10px;
        }
</style>
<body>
    <div class="container mt-5">
        <h2>Create Animal</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="text" class="form-control" id="picture" name="picture" value="<?php echo $picture; ?>">
            </div>
            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" class="form-control" id="size" name="size" value="<?php echo $size; ?>">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
            </div>
            <div class="form-group">
                <label for="vaccinated">Vaccinated:</label>
                <input type="checkbox" id="vaccinated" name="vaccinated" value="1">
            </div>
            <div class="form-group">
                <label for="breed">Breed:</label>
                <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $breed; ?>">
            </div>
            <div class="form-group">
                <label for="availability">availability:</label>
                <input type="text" class="form-control" id="availability" name="availability" value="<?php echo $availability; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a> 
            <a href="dashboard.php" class="btn btn-warning">Back</a>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>