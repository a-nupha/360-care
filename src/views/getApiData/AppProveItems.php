<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
echo 'test'
// $servername = "localhost";
// $username = "id3526601_anupha";
// $password = "ok223201";
// $dbname = "id3526601_projest_vue_barcode";
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// $data_approve = json_decode($_POST['data_approve'], true);

// echo $data_approve.count."= total data \r\n \r\n";
// echo json_encode($data_approve);
//chk pid
// dataInsert($data_approve,$conn);

function dataInsert($data,$conn){
   
    $i=0;
        $barcode = $data[$i]['barcode'];
        $branch_id = $data[$i]['branch_id'];
        $total = $data[$i]['total'];
        $status = $data[$i]['status'];
        $add_date = $data[$i]['add_date'];
        $add_time = $data[$i]['add_time'];
        $quantity = $data[$i]['quantity'];
        $status_id = $data[$i]['status_id'];
        $pid_user = $data[$i]['pid_user'];
        $pid_approve = $data[$i]['pid_approve'];
        $approve_id=$data[$i]['approve_id'];
        $remark = $data[$i]['remark'];

        $barcode_stock = $data[$i]['barcode'];

        $dataStock= array();
        $queryStock = "select * from stock where branch_id = ".$branch_id." and barcode = '".$barcode_stock."'";
        $resultItems = $conn->query($queryStock);
        if($resultItems)
        {
        while ($row=mysqli_fetch_assoc($resultItems))
            {   
            $dataStock[]=$row;
            }
        }
        else
        {

        }

        $quantity_old = (int)$dataStock[0]['quantity_stock'];

        $new_quantity_in = $quantity_old - $data[$i]['quantity'];
        $query = "update stock set quantity_stock = '$new_quantity_in' where branch_id = '".$data[$i]['branch_id']."' and barcode = '".$barcode_stock."'";
        $result = $conn->query($query);
        if($result)
        {
              echo "\r\n update result1 Save Done. \r\n";
            $secess1 = true
        }
        else
        {
             echo "\r\n update Error Save [".$query."] \r\n";
        }
     
        $queryInsert="INSERT INTO `transaction_out`(`id`, `barcode`, `add_date`, `add_time`, `branch_id`, `quantity`, `status_id`, `approve_id`, `pid_user`, `pid_approve`, `remark`) 
        VALUES (null,'".$barcode."','".$add_date."','".$add_time."','".$branch_id."','".$quantity."','".$status_id."','".$approve_id."','".$pid_user."','".$pid_approve."','".$remark."')";

        $resultInsertSuccess = $conn->query($queryInsert);
        if($resultInsertSuccess)
        {
            echo "\r\n resultInsertSuccess Save Done. \r\n";
            $secess2 = true
            $delete_query="DELETE FROM `items_approve` WHERE `barcode`='$barcode' AND `branch_id`='$branch_id'";
            $resultDelete = $conn->query($delete_query);
            if($resultDelete)
            {
                echo "\r\n delete_query result1 Save Done. \r\n";
                $secess2 = true
            }
            else
            {
                 echo "\r\n delete_query Error Save [".$query."] \r\n";
            }

        }
        else
        {
            echo "\r\n Error Save [".$queryInsert."] \r\n";
        }
}


$conn->close();
?>