<?php
session_start();
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
        
        header("Location: login.php");
        exit;
    }

  
    if (!isset($_POST["pet_id"])) {
        
        header("Location: home.php");
        exit;
    }

    
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : $_SESSION['adm'];

    
    $petId = mysqli_real_escape_string($conn, $_POST["pet_id"]);

    
    $checkSql = "SELECT * FROM pet_adoption WHERE user_id = ? AND pet_id = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "ii", $userId, $petId);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    if (!$checkResult) {
        die("Database query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($checkResult) > 0) {
        
        $_SESSION['message'] = "You have already adopted this pet.";
        header("Location: home.php");
        exit;
    }

    
    $insertSql = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) VALUES (?, ?, NOW())";
    $insertStmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($insertStmt, "ii", $userId, $petId);
    if (!mysqli_stmt_execute($insertStmt)) {
        die("Database query failed: " . mysqli_error($conn));
    }

    
    $_SESSION['message'] = "Congratulations! You have successfully adopted the pet.";
    header("Location: home.php");
    exit;
} else {
    
    header("Location: home.php");
    exit;
}


mysqli_close($conn);
?>
