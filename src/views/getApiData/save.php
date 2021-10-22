<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

   $pid = $_POST['pid'];
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $tname = $_POST['tname'];
   $bdate = $_POST['bdate'];
   $email = $_POST['email'];
   $tel =  $_POST['tel'];
   $flag_id = $_POST['flag_id'];
   $now_date = $_POST['now_date'];
   $rcode_id = $_POST['rcode_id'];
   $index1 = $_POST['index1'];
   $index2 = $_POST['index2'];
   $role_id = $_POST['role_id'];




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
if ($result->num_rows > 0) {
    // output data of each row
    // while($row = $result->fetch_assoc()) {
    //     $response[] = $row;
      
    // }
      echo 'false';
} else {
   $query = "insert into user(pid,fname,lname,tname,bdate,email,tel, flag_id, now_date,rcode_id,index1,index2,branch_id,role_id) values 
   ($pid,'".$fname."','".$lname."','".$tname."','".$bdate."','".$email."','".$tel."', '".$flag_id."', '".$now_date."','".$rcode_id."','".$index1."','".$index2."','".$branch_id."','".$role_id."')";
   $result = $conn->query($query);
   echo json_encode($result);
}


$conn->close();
?>