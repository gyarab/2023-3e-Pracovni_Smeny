<?php

$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$input = $_POST['input'];
$sql = " SELECT * FROM board WHERE id_board= $input";
$get = mysqli_query($conn, $sql);
$saved_data = array();
while ($row = $get->fetch_assoc()) {
    //$saved_data[0] = $row['caption'];
    //$content = $row['content'];
    $saved_data[0] = $row['color'];
    $saved_data[1] = $row['employee_full'];
    $saved_data[2] = $row['employee_part'];
    $saved_data[3] = $row['manager'];
    $saved_data[4] = $row['caption'];

}
$conn->close();
echo json_encode($saved_data);
?>