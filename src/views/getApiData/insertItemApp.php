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

$data_approve = json_decode($_POST['data_approve'], true);

// echo $data_approve.count."= total data \r\n \r\n";
echo json_encode($data_approve);
//chk pid
dataInsert($data_approve,$conn);

function dataInsert($data,$conn){
    $i=0;
        $barcode = $data['barcode'];
        $branch_id = $data['branch_id'];
        $total = $data['total'];
        $status = $data['status'];
        $add_date = $data['add_date'];
        $add_time = $data['add_time'];
        $quantity = $data['quantity'];
        $status_id = $data['status_id'];
        $pid_user = $data['pid_user'];
        $pid_approve = $data['pid_approve'];
        $approve_id=$data['approve_id'];
        $remark = $data['remark'];

        $barcode_stock = $data['barcode'];

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
        echo "old data = ".$quantity_old;
        $new_quantity_in = $quantity_old - $data['quantity'];
        echo "new data = ".$new_quantity_in;

        $selectPriceCost = "select * from items where barcode='$barcode'";
        $selectResult = $conn->query($selectPriceCost);
        $PriceCostArr=array();

        if($selectResult)
        while ($row=mysqli_fetch_assoc($selectResult))
            $PriceCostArr[]=$row;
        else
            echo "Select priceCost error ".$selectPriceCost;
        
        $price=$PriceCostArr[0]['price'];
        $cost=$PriceCostArr[0]['cost'];

        $query = "update stock set quantity_stock = '$new_quantity_in' where branch_id = '".$data['branch_id']."' and barcode = '".$barcode_stock."'";
        

        $result = $conn->query($query);
        if($result)
        {
            echo "\r\n update result1 Save Done. \r\n";
            $secess1 = true;
        }
        else
        {
            echo "\r\n update Error Save [".$query."] \r\n";
        }

        if($status_id=="สูญหาย")
            InsertUpdateReport($conn,$add_date,$barcode,$quantity,$branch_id);
        else if($status_id=="ชำรุด")
            InsertUpdateReportBroken($conn,$add_date,$barcode,$quantity,$branch_id);
        $queryInsert="INSERT INTO `transaction_out`(`id`, `barcode`, `add_date`, `add_time`, `branch_id`, `quantity`, `status_id`, `approve_id`, `pid_user`, `pid_approve`, `remark`, `price`, `cost`) 
        VALUES (null,'".$barcode."','".$add_date."','".$add_time."','".$branch_id."','".$quantity."','".$status_id."','".$approve_id."','".$pid_user."','".$pid_approve."','".$remark."','".$price."','".$cost."')";

        $resultInsertSuccess = $conn->query($queryInsert);
        if($resultInsertSuccess)
        {
            echo "\r\n resultInsertSuccess Save Done. \r\n";
            $secess2 = true;
            $delete_query="DELETE FROM `items_approve` WHERE `barcode`='$barcode' AND `branch_id`='$branch_id' AND  `status`='$status'";
            $resultDelete = $conn->query($delete_query);
            if($resultDelete)
            {
                echo "\r\n delete_query result1 Save Done.".$delete_query." \r\n";
                $secess2 = true;
            }
            else
            {
                 echo "\r\n delete_query Error Save [".$delete_query."] \r\n";
            }

        }
        else
        {
            echo "\r\n Error Save [".$queryInsert."] \r\n";
        }
}

function InsertUpdateReport($conn,$date,$barcode,$quantity,$branch_id){

    $selectquery="SELECT * FROM `report` WHERE `date`='$date' AND `barcode`='$barcode' AND `branch_id`='$branch_id'";
    $selectresult = $conn->query($selectquery);
    $dataselect=array();
    
    
    
    if($selectresult)
        while ($row=mysqli_fetch_assoc($selectresult))
            $dataselect[]=$row;
    
            echo "count = ".count($dataselect);
    
            if(count($dataselect)!=0){
    
                $oldTotal=(int)$dataselect[0]['out'];
                $noOldTotal=(int)$dataselect[0]['no'];
                echo "\r\n \r\n \r\n no total echo = ".$noOldTotal;
                // echo "\r\n old total=".$oldTotal." new=".$quantity." \r\n";

                $ConQuantity=(int)$quantity;
                $newNoQuantity=$ConQuantity + $noOldTotal;
                $newQuantity=  $ConQuantity + $oldTotal;

                $updatequery="UPDATE `report` SET `out`='$newQuantity',`no`='$newNoQuantity' WHERE `date`='$date' AND `barcode`='$barcode' AND `branch_id`='$branch_id'";
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
                $queryReport = "INSERT INTO `report`(`id`, `date`, `branch_id`, `barcode`, `in`, `out`, `yes`, `no`, `broken`) VALUES (null,'".$date."','".$branch_id."','".$barcode."','0','".$quantity."','0','".$quantity."','0')";
                echo "\r\n". $queryReport;
                $updateResult = $conn->query($queryReport);
                echo "\r\n";
                if($updateResult)
                {
                    echo "insert Save Done.";
                }
                else
                {
                    echo "insert Error Save [".$queryReport."]";
                }
            
            }
    

}

function InsertUpdateReportBroken($conn,$date,$barcode,$quantity,$branch_id){

    $selectquery="SELECT * FROM `report` WHERE `date`='$date' AND `barcode`='$barcode' AND `branch_id`='$branch_id'";
    $selectresult = $conn->query($selectquery);
    $dataselect=array();
    
    
    
    if($selectresult)
        while ($row=mysqli_fetch_assoc($selectresult))
            $dataselect[]=$row;
    
            echo "count = ".count($dataselect);
    
            if(count($dataselect)!=0){
    
                $oldTotal=(int)$dataselect[0]['out'];
                $noOldTotal=(int)$dataselect[0]['broken'];
                echo "\r\n \r\n \r\n no total echo = ".$noOldTotal;
                // echo "\r\n old total=".$oldTotal." new=".$quantity." \r\n";

                $ConQuantity=(int)$quantity;
                $newNoQuantity=$ConQuantity + $noOldTotal;
                $newQuantity=  $ConQuantity + $oldTotal;

                $updatequery="UPDATE `report` SET `out`='$newQuantity',`broken`='$newNoQuantity' WHERE `date`='$date' AND `barcode`='$barcode' AND `branch_id`='$branch_id'";
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
                $queryReport = "INSERT INTO `report`(`id`, `date`, `branch_id`, `barcode`, `in`, `out`, `yes`, `no`, `broken`) VALUES (null,'".$date."','".$branch_id."','".$barcode."','0','".$quantity."','0','0','".$quantity."')";
                echo "\r\n". $queryReport;
                $updateResult = $conn->query($queryReport);
                echo "\r\n";
                if($updateResult)
                {
                    echo "insert Save Done.";
                }
                else
                {
                    echo "insert Error Save [".$queryReport."]";
                }
            
            }
    

}
$conn->close();
?>