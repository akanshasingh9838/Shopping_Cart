<?php
 include("Admin/config.php");
 $json=array();
 if(isset($_POST['product_id']))
 {
    if(isset($_SESSION['product_cart']))
    {

    }
    else
    {
        $_SESSION['product_cart'][1]=$product_id;
    }
 }
 else
 {
  
 }
?>





$(document).ready(function(){
  alert("hello yr");
  $(".addcart").click(function(){
    var productid=$(this).data('productid');
    alert("hey "+productid);
    if(product_id=='')
    {
      alert("Product not found");
      console.log("product not found");
    }
    else{
      $.ajax({
        type:"POST",
        url:"ajax/cartprocess.php",
        data:{'product_id':product_id},
        success:function(response){
          var getval=JSON.parse(response);
        }
      });
    }

      })
    }

  });
});