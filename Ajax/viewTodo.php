<?php
include("conn.php");



$query = "SELECT * FROM `todo`";
$result = mysqli_query($conn , $query);
if(!$result){
    echo "Error: " . mysqli_error($conn);
}
else{
    $data = array();
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}
echo json_encode($data);


?>