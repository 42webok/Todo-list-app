<?php
include("conn.php");


if(isset($_POST['sid'])){
    $id = $_POST['sid'];
    $query = "DELETE FROM `todo` WHERE id = '$id'";
    $result = mysqli_query($conn , $query);
    if(!$result){
        echo 0;
    }
    else{
       echo 1;
}
}

?>