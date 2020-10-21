<?php
//session_start();
include('dsheader.php');
include("Admin/config.php");  

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo "<script>alert($id)</script>";
    foreach ($_SESSION['cart'] as $key => $value) {
      // echo $value['id2'];
      if ($id == $value['id2']) {
          unset($_SESSION['cart'][$key]);
      }
    }
}

$name_array = array();
$productid_array = array();

if(isset($_GET['order']))
{
  if($_GET['order']=='add')
  {
    foreach ($_SESSION['cart'] as $key => $value)
    {
      $id=$value['id2'];
      $name=$value['name2'];
      $price=$value['price2']*$value['quantity2'];
      array_push($name_array,$name);
      array_push($productid_array,$id);
      
    }
    $cart_data=implode(',',$name_array);
    $id_data=implode(',',$productid_array);
    $datetime=date("Y-m-d h:i:sa");
    $status="1";

    $sql = "INSERT INTO orders (product_id,cart_data,total,`status`,`datetime`)
      VALUES ('$id_data','$cart_data','$price','$status','$datetime')";
    //echo $sql;
      if ($conn->query($sql) === TRUE) {
        unset($_SESSION['cart']);
        // echo "<script>alert('Your order is placed')</script>";
      ?>

        <script>
          alert('Order Added');
          window.location.href = 'product.php';
        </script>
<?php
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

  }
 
}
?>

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">


             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $totalPrice; ?>
                      <?php foreach ($_SESSION['cart'] as $key=>$value) : ?>
                      <tr>
                        <td><a class="remove" href="cart.php?id=<?php echo $value['id2'] ?>"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="Admin/uploads/<?php echo $value['image2']; ?>" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#"><?php echo $value['name2']; ?></a></td>
                        <td>$<?php echo $value['price2']; ?></td>
                        <td><input class="aa-cart-quantity" type="number" value="<?php echo $value['quantity2']; ?>"></td>
                        <td>$<?php echo $value['quantity2']*$value['price2']; ?></td>
                      </tr>
                      <?php $totalPrice += $value['price2']*$value['quantity2'] ?>
                      <?php endforeach; ?>
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>$<?php echo $totalPrice ?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>$<?php echo $totalPrice ?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="cart.php?order=add" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


<?php include('dsfooter.php'); ?>