<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$branch_id = $_POST['branch_id'];

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
$query = "SELECT `stock`.*, `items`.`name`, `items`.`desc`,`items`.`price`,`items`.`cost`, `category`.`cate_name`,`category`.`cate_id` FROM `stock` , `items` , `category` WHERE `stock`.`branch_id`='$branch_id' AND `items`.`barcode` = `stock`.`barcode` AND `items`.`cate_id`= `category`.`cate_id`
";
// echo $query;

$result = $conn->query($query);
$returnData = array();
if($result)
{
    $returnData=array();
    while ($row=mysqli_fetch_assoc($result))
    {   
        $returnData[]=$row;
    }
    echo json_encode($returnData);
}
else
{
 echo 'error';
}




$conn->close();
?>