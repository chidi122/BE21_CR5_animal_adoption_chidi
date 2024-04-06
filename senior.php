<?php

require_once "db_connect.php";


$sql = "SELECT * FROM animal WHERE age > 8"; 
$result = mysqli_query($conn, $sql); 


if ($result && mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Animals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Senior Animals Available for Adoption</h1>
        <div class="row">
            <?php
            
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $row['picture']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text">Age: <?php echo htmlspecialchars($row['age']); ?></p>
                            <p class="card-text">Location: <?php echo htmlspecialchars($row['location']); ?></p>
                            <p class="card-text">Description: <?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="card-text">Size: <?php echo htmlspecialchars($row['size']); ?></p>
                            <p class="card-text">Vaccinated: <?php echo $row['vaccinated'] ? 'Yes' : 'No'; ?></p>
                            <p class="card-text">Breed: <?php echo htmlspecialchars($row['breed']); ?></p>
                            <p class="card-text">availability: <?php echo htmlspecialchars($row['availability']); ?></p>
                            
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
} else {
 
    echo "<p>No senior animals found.</p>";
}


mysqli_close($conn); 
?>


























