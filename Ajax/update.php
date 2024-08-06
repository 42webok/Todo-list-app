<?php
include("conn.php");

if(isset($_POST['sid'])){
    $sid = $_POST['sid'];
    $sql = "SELECT * FROM todo WHERE id = '$sid'";
    $result = mysqli_query($conn, $sql);
     if(!$result){
        die("Error: " . mysqli_error($conn));
     }
     else{
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
     }
        
    
}









?>