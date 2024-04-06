<?php
require_once 'db_connect.php';


$id = isset($_GET['id']) ? $_GET['id'] : die("No ID provided.");


$sql = "SELECT * FROM `animal` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Animal not found.");
}
$animal = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($animal['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2><?= htmlspecialchars($animal['name']); ?></h2>
    <div>
        <img src="<?= htmlspecialchars($animal['picture']); ?>" alt="Animal Picture" class="img-fluid">
        <p>Description: <?= htmlspecialchars($animal['description']); ?></p>
        <p>Age: <?= htmlspecialchars($animal['age']); ?> years</p>
        <p>Size: <?= htmlspecialchars($animal['size']); ?></p>
        <p>Vaccinated: <?= $animal['vaccinated'] ? 'Yes' : 'No'; ?></p>
        <p>Breed: <?= htmlspecialchars($animal['breed']); ?></p>
        
        <?php if (isset($_SESSION["admin"])): ?>
            <a href="update.php?id=<?= $animal['id']; ?>" class="btn btn-primary">Update This Animal</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>




