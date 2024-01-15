<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$conn = new mysqli("localhost", "Dulla", "Dulla2006-", "flychat_1");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = $_POST['userID']; // Make sure to validate and sanitize input

// File handling
$newAvatar = $_FILES['newAvatar'];
$uploadPath = "your_upload_directory/"; // Replace with the actual path where you want to store the avatars
$uploadedFile = $uploadPath . basename($newAvatar['name']);

if (move_uploaded_file($newAvatar['tmp_name'], $uploadedFile)) {
    // Update the avatar in the database
    $avatarURL = "https://localhost/" . $uploadedFile; // Replace with the actual URL structure of your avatars
    $sql = "UPDATE users SET avatar = '$avatarURL' WHERE id = $userID";

    if ($conn->query($sql) === TRUE) {
        echo "Avatar updated successfully";
    } else {
        echo "Error updating avatar: " . $conn->error;
    }
} else {
    echo "Error uploading file";
}

$conn->close();
?>

