<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

   $branch_id = $_POST['branch_id'];
   $branch_name = $_POST['branch_name'];




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
$query = "SELECT branch_id FROM branch WHERE branch_id = '$branch_id'";
$result = $conn->query($query);

$response = array();
if ($result->num_rows > 0) {
      echo 'false';
} else {
   $query = "insert into branch(branch_id,branch_name) values ($branch_id,'".$branch_name."')";
   $result = $conn->query($query);
   echo json_encode($result);
}


$conn->close();
?>