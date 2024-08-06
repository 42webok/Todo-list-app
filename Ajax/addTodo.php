<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entry = $_POST['entry'];
    $id = $_POST['id'];

    // Insert the new todo entry into the database
    $query = "INSERT INTO `todo` (id , entry) VALUES ('$id' , '$entry') ON DUPLICATE KEY UPDATE entry = '$entry'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "Error: " . mysqli_error($conn);
    }
    else{
        echo "Todo added successfully";
    }
  
}
?>
