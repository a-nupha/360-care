<?php
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$dataStock = json_decode($_POST['dataStork'], true);

echo json_encode($dataStock)."\r\n";

$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$barcode=$dataStock['barcode'];
$name=$dataStock['name'];
$desc=$dataStock['desc'];
$price=$dataStock['price'];
$cost=$dataStock['cost'];
$remark=$dataStock['remark'];
$cate_id=$dataStock['cate_id'];

$response = array();
$query  = "UPDATE `items` SET `name`='$name',`desc`='$desc',`cate_id`='$cate_id',`price`='$price',`cost`='$cost',`remark`='$remark' WHERE `barcode`='$barcode'";
$result = $conn->query($query);

if($result){
    echo 'update done.'.$query;
}else{
    echo 'update error :'.$query;
}

$conn->close();
?>