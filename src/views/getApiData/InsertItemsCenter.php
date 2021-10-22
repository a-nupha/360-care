<?php
ini_set('display_errors', 1);
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

$sql = "SELECT * FROM items_center";
$result = $conn->query($sql);
$dataItems = array();

if($result){
    while ($row=mysqli_fetch_assoc($result)){   
        $dataItems[]=$row;
    }
}else{
    // echo "Error";
}

$response = array();
$barcode = array();
$barcode = json_decode($_POST['dataInsert'], true);

SearchArray($dataItems,$barcode,$conn);


function SearchArray($dataItems,$barcode,$conn){
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else{
        // echo "connected successfully";
    }
    // echo "\r\n - \r\n -\r\n ------------------------into function ----------------------";
    for($i=0;$i<count($barcode);$i++)
    { 
        $barcode_item=$barcode[$i]['barcodeItems'];
        $iterition = 0;
        $key = array_search($barcode[$i]['barcodeItems'], array_column($dataItems, 'barcode'),true); // check item
        // echo "\r\n\r\n".$barcode[$i]['barcode']." key =".$key."\r\n";
        // echo gettype($key)."\n\r\n\r\n\r\n\r\n\r\n\r\n";
        $databarcodeTracking=$barcode[$i]['databarcodeTracking'];
        $TypeId=$barcode[$i]['TypeId'];
        $price=$barcode[$i]['price'];
        $cost=$barcode[$i]['cost'];
        $qty=$barcode[$i]['qty'];
        $barcodeItems=$barcode[$i]['barcodeItems'];
        $remark=$barcode[$i]['remark'];


        if(gettype($key)=='boolean'){

            $query="INSERT INTO `items_center`(`databarcodeTracking`, `TypeId`, `price`, `cost`, `qty`, `barcodeItems`, `remark`) 
            VALUES ('".$databarcodeTracking."','".$TypeId."','".$price."','".$cost."','".$qty."','".$barcodeItems."','".$remark."')";
             $result1 = $conn->query($query);
             if($result1)
                echo "1";
             else
             {
                echo "0";
             }
        }else{
            echo "1";
        }        
    }
}




$conn->close();
?>


