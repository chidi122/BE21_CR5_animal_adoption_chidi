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
    
    $deleteSql = "DELETE FROM animal WHERE id = $animalId";
    $deleteResult = mysqli_query($conn, $deleteSql);
    if ($deleteResult) {
        
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error deleting animal: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Animal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Animal</h2>
        <p>Are you sure you want to delete the following animal?</p>
        <p><strong>Name:</strong> <?php echo $animalData['name']; ?></p>
        <p><strong>Description:</strong> <?php echo $animalData['description']; ?></p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a> 
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>












