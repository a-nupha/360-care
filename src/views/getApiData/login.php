<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

   $index1 = $_POST['userName'];
   $index2 = $_POST['passWord'];

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

//chk pid
$query = "SELECT * FROM user WHERE index1 = '$index1' And index2 = '$index2'";
$result = $conn->query($query);

$response = array();
$error = array();
if ($result->num_rows > 0) {
    
    $returnData = array();// output data of each row
    while($row = $result->fetch_assoc()) {
        // $response[] = $row;
        array_push($returnData, $row);
        // echo $response;
    }
    echo json_encode($returnData);
} else {
   //  insert data
    echo 'password is incorrect';
}


$conn->close();
?>