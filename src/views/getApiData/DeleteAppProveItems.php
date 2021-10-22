<?php
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
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

$data = json_decode($_POST['data_approve'], true);

// echo $data_approve.count."= total data \r\n \r\n";
//chk pid
$barcode = $data['barcode'];
$branch_id = $data['branch_id'];
$status = $data['status'];


$delete_query="DELETE FROM `items_approve` WHERE `barcode`='$barcode' AND `branch_id`='$branch_id' AND  `status`='$status'";
$resultDelete = $conn->query($delete_query);
if($resultDelete)
{
      echo "\r\n resultDelete result1 Save Done. \r\n";
    $secess1 = true;
}
else
{
     echo "\r\n resultDelete Error Save [".$delete_query."] \r\n";
}

$conn->close();
?>