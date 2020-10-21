<?php
 session_start(); 
 include("Admin/config.php");
 
 $id=$_POST['productid'];
 //echo $id;
 if(isset($_SESSION['cart']))
    {
        $cart=$_SESSION['cart'];
    }
  else
  { 
      $cart=array();   
  }

 $sql="SELECT * FROM products WHERE `product_id` = '$id' ";
   $result=$conn->query($sql);
   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {   
          $productid1=$row['product_id'];    
          $productname1=$row['name'];
          $productprice1=$row['price'];
          $productimage1=$row['image'];
         
  
          $narray=array(
              "id2"=>$productid1,
              "name2"=>$productname1,
              "price2"=>$productprice1,
              "image2"=>$productimage1,
              "quantity2"=>1
          );
          $_SESSION['cart']=$narray;
          array_push($cart,$_SESSION['cart']);        
          for($j=0;$j<=count($cart)-2;$j++) {
              if($cart[$j]["name2"]==$narray["name2"] && $cart[$j]["price2"]==$narray["price2"]) {
                $cart[$j]["quantity2"]=$cart[$j]["quantity2"]+1;
                  array_pop($cart);
              }
          }
      }
       $_SESSION['cart']=$cart;
       echo count($_SESSION['cart']);
     }

    else {
       echo "0 results";
     }
    
?>

