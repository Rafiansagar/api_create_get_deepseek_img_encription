<?php
include '../db.php';

header("Content-Type: application/json");

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response['status'] = 'error';
    $response['message'] = 'DB Connection Failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result) {
    $response['status'] = 'success';
    $response['api-data1'] = array();
    while ($row = $result->fetch_assoc()) {
        $response['api-data1'][] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'content' => $row['content'],
            'created_at' => $row['created_at']
        );
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error executing query: ' . $conn->error;
}

echo json_encode($response);

$conn->close();
?>
