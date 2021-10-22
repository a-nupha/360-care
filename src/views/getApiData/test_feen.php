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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date='20190410';
$barcode='123432222333';
$quantity='1';

$selectquery="SELECT * FROM `report` WHERE `date`='$date' AND `barcode`='$barcode'";
$selectresult = $conn->query($selectquery);
$dataselect=array();



if($selectresult)
    while ($row=mysqli_fetch_assoc($selectresult))
        $dataselect[]=$row;

        echo "count = ".count($dataselect);

        if(count($dataselect)!=0){

            
            $oldTotal=(int)$dataselect[0]['out'];
            // echo "\r\n old total=".$oldTotal." new=".$quantity." \r\n";
            $ConQuantity=(int)$quantity;
            $newQuantity=  $ConQuantity + $oldTotal;
            
            echo "\r\n cal=". $newQuantity."\r\n";

            $updatequery="UPDATE `report` SET `out`='$newQuantity',`yes`='$quantity' WHERE `date`='$date' AND `barcode`='$barcode'";
            echo $updatequery;
            $updateResult = $conn->query($updatequery);
            echo "\r\n";
            if($updateResult)
            {
                echo "update Save Done.";
            }
            else
            {
                echo "update Error Save [".$updatequery."]";
            }
    
        }else if(count($dataselect)==0){
    
            echo "\r\n";
            $queryReport = "INSERT INTO `report`(`id`,`date`, `barcode`, `in`, `out`, `yes`, `no`) VALUES (null,'".$date."','".$barcode."','0','".$quantity."','".$quantity."','0')";
            echo "\r\n". $queryReport;
            $updateResult = $conn->query($queryReport);
            echo "\r\n";
            if($updateResult)
            {
                echo "insert Save Done.";
            }
            else
            {
                echo "insert Error Save [".$updatequery."]";
            }
        
        }




        
// ini_set('display_errors', 1);
// // ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// header('Access-Control-Allow-Origin: *');
// header('Content-type: application/json');

// $servername = "localhost";
// $username = "id3526601_anupha";
// $password = "ok223201";
// $dbname = "id3526601_projest_vue_barcode";
// // Create connection

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $date='20190404';
// $barcode='123432222333';
// $quantity='1';

// $selectquery="SELECT * FROM `report` WHERE `date`='$date' AND `barcode`='$barcode'";
// $selectresult = $conn->query($selectquery);
// $dataselect=array();



// if($selectresult)
//     while ($row=mysqli_fetch_assoc($selectresult))
//         $dataselect[]=$row;

//         echo "count = ".count($dataselect);

//         if(count($dataselect)!=0){

//             echo "\r\n if 1 \r\n";
//             $oldTotal=(int)$dataselect[0]['in'];
//             $newQuantity=(int)$quantity+$oldTotal;
            
//             $updatequery="UPDATE `report` SET `in`='$newQuantity' WHERE `date`='$date' AND `barcode`='$barcode'";
//             echo $updatequery;
//             $updateResult = $conn->query($updatequery);
        
//             if($updateResult)
//             {
//                 echo "update Save Done.";
//             }
//             else
//             {
//                 echo "update Error Save [".$updatequery."]";
//             }
    
//         }else if(count($dataselect)==0){
    
//             echo "\r\n";
//             $queryReport = "INSERT INTO `report`(`date`, `barcode`, `in`, `out`, `yes`, `no`) VALUES ('".$date."','".$barcode."','".$quantity."','0','0','0')";
//             echo "\r\n". $queryReport;
//             $updateResult = $conn->query($queryReport);
        
//             if($updateResult)
//             {
//                 echo "insert Save Done.";
//             }
//             else
//             {
//                 echo "insert Error Save [".$updatequery."]";
//             }
        
//         }

?>
