<?php
include 'db.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);
$response = array();

if($conn) {
    
    $sql = "select * from posts";
    $result = mysqli_query($conn,$sql);
    if ($result){
        header("Content-Type: JSON");
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['title'] = $row['title'];
            $response[$i]['content'] = $row['content'];
            $response[$i]['created_at'] = $row['created_at'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

} else {
    echo "DB Connection Failed.";
}