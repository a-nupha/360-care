<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$branch_id = $_POST['branch_id'];
$date_in = $_POST['date_in'];
$date_out = $_POST['date_out'];
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
$query = "SELECT re.date,re.barcode,it.name,re.in,re.out,it.cost, 
(re.out*it.cost) AS total_cost, 
it.price,re.yes AS sale, 
(re.yes*it.price) AS total_sale,
re.no AS items_lost, 
(re.no*it.cost) AS total_lost,
re.broken,
(re.broken*it.cost) AS total_broken
FROM report AS re, items AS it
WHERE re.barcode=it.barcode AND re.date BETWEEN '$date_in' AND '$date_out' AND re.branch_id = '$branch_id'";

$result = $conn->query($query);

$response = array();
$error = array();
if ($result->num_rows > 0) {
    
    $returnData = array();// output data of each row
    while($row = $result->fetch_assoc()) {

        array_push($returnData, $row);

    }
    echo json_encode($returnData);
} else {

    echo 'error';
}


$conn->close();
?>