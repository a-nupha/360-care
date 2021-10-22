<?php
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$pid = $_POST['pid'];
$index2 = $_POST['index2'];
$role_id = $_POST['role_id'];
// echo $role_id;


$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$query = "SELECT pid FROM user WHERE pid = '$pid'";
$result = $conn->query($query);

$response = array();
$query  = "UPDATE user SET index2='$index2',role_id = '$role_id' WHERE pid='$pid'";
$result = $conn->query($query);
// echo $query;
echo json_encode($result);

$conn->close();
?>