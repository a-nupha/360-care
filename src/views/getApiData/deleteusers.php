<?php
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$pid = $_POST['pid'];

$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//chk pid
$query = "SELECT pid FROM user WHERE pid = '$pid'";
$result = $conn->query($query);

$response = array();
if ($result->num_rows < 0) {

    echo 'false';
} else {
$sql = "DELETE FROM user WHERE pid= '$pid'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode($conn->query($sql));
    } else {
        echo json_encode("Error deleting record: " . $conn->error);
    }
}


$conn->close();
?>