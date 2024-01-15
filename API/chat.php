<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$conn = new mysqli("localhost", "Dulla", "Dulla2006-", "flychat_1");

if (mysqli_connect_error()) {
    echo json_encode(array('success' => false, 'error' => 'Database connection error'));
    exit();
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $msg = $_POST['Messages'];
        $from = $_POST['From'];
        $to = $_POST['To'];
        
        $sql = "INSERT INTO chats (sender_id, receiver_id, message) VALUES ('$from', '$to', '$msg')";
        $res = mysqli_query($conn, $sql);

        $response = ['message' => 'Data received successfully'];
        echo json_encode($response);
    
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Invalid request method']);
    }

    $conn->close();
}


