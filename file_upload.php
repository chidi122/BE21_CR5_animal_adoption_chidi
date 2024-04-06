<?php

function fileUpload($picture)
{
    $targetDir = "pictures/"; 
    $defaultPictureName = "default_product.jpg"; 
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; 

    if ($picture["error"] == 4) { 
        return [
            "filePath" => $defaultPictureName,
            "message" => "No picture has been chosen, but you can upload an image later!",
            "success" => false
        ];
    } else {
        $checkIfImage = getimagesize($picture["tmp_name"]);
        if (!$checkIfImage) {
            return [
                "filePath" => $defaultPictureName,
                "message" => "The file is not a valid image.",
                "success" => false
            ];
        }

        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) {
            return [
                "filePath" => $defaultPictureName,
                "message" => "Only JPG, JPEG, PNG, and GIF files are allowed.",
                "success" => false
            ];
        }

        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        
        $pictureName = uniqid("", true) . "." . $ext;

        if (move_uploaded_file($picture["tmp_name"], $targetDir . $pictureName)) {
            return [
                "filePath" => $targetDir . $pictureName,
                "message" => "The file has been uploaded successfully.",
                "success" => true
            ];
        } else {
            return [
                "filePath" => $defaultPictureName,
                "message" => "Failed to upload the file.",
                "success" => false
            ];
        }
    }
}
