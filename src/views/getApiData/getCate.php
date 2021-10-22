<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM category";
$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    
    $returnData = array();// output data of each row
    while($row = $result->fetch_assoc()) {
        // $response[] = $row;
        array_push($returnData, $row);
        // echo $response;
    }
    echo json_encode($returnData);
} else {
    echo "0 results";
}
$conn->close();
?>