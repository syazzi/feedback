<?php
include 'config/database.php';
$body = $_POST['body'];
$user_id = $_POST['user_id'];
//form submit

$sql = "INSERT INTO feedback (user_id, body) VALUES ('$user_id', '$body')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);
?>
