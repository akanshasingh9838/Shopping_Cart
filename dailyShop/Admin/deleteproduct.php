<?php
    include('config.php');
    $id=$_GET['product_id'];
    echo $_GET['product_id'];
    
    $sql = "DELETE FROM products WHERE `product_id`='$id'";

    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }



?>