<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');



$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM items_center";
$result = $conn->query($sql);
$dataItems = array();

if($result){
    while ($row=mysqli_fetch_assoc($result)){   
        $dataItems[]=$row;
    }
}else{
    // echo "Error";
}

echo json_encode($dataItems);

$conn->close();
?>