<?php
    // $siteurl="http://localhost/training/Task12-AddToCart/";
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="varnika";
    $dbname="cart";

    $conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);

    if($conn -> connect_error){
        die("connection failed: ".$conn -> connect_error);
    }
    echo "connected successfully";
?>