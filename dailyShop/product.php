<?php
  include('dsheader.php');
  include("Admin/config.php");  
?>

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
               <!-- start single product item -->

               <?php
               if(isset($_GET['page']))
               {
                 $page=$_GET['page'];
               }
               else
               {
                 $page=1;
               }
               $sql = "SELECT * FROM products";
               $result = $conn->query($sql);
              if ($result->num_rows > 0) {
              // output data of each row
                  $count=mysqli_num_rows($result);
                  $per_page=10;
                  $no_of_page=ceil($count/$per_page);
                  $start=($page-1)*$per_page;

                  // This condirtion works when we choose any category
                  if (isset($_GET['cat']))
                  {
                    $cat=$_GET['cat'];
                    $sql="SELECT * FROM products WHERE `category`='$cat' limit $start,$per_page";
                    $res=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($res)>0)
                    {
                        //echo("Data received");
                        while($row = $res->fetch_assoc())
                         {  
                          echo '<li>';
                          echo '<figure>';                         
                          echo '<a class="aa-product-img" href="product-detail.php?detailid='.$row["product_id"].'"><img src="Admin/uploads/'.$row["image"].'" height=300 width=250 alt="'.$row["name"].' img"></a>';
                          echo '<a class="aa-add-card-btn addcart" href="#" data-productid="'.$row["product_id"].'"><span class="fa fa-shopping-cart"></span>Add To Cart</a>';
                          echo '<figcaption>';
                          echo '<h4 class="aa-product-title"><a href="#">'.$row["name"].'</a></h4>';
                          echo '<span class="aa-product-price">RS.'.$row["price"].'</span><span class="aa-product-price"></span>'; //<del>$65.50</del>
                          echo '<p class="aa-product-descrip">'.$row["description"].'</p>';
                          echo ' </figcaption>';
                          echo ' </figure> ';
                          echo '<div class="aa-product-hvr-content">';
                          echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>';
                          echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>';
                          echo '<a href="#" class="" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search search" data-id="'.$row["product_id"].'"></span></a>';                           
                          echo '</div>';
                          //product badge
                          echo '<span class="aa-badge aa-sale" href="#">SALE!</span>';
                          echo '</li>';        
                          }
                      }
                  }
                  
                  //This work when we choose tags
                  else if (isset($_GET['tag']))
                  {
                    $tag=$_GET['tag'];
                    $sql="SELECT * FROM products WHERE `tags` LIKE '%$tag%' limit $start,$per_page";
                    $res=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($res)>0)
                    {
                        //echo("Data received");
                        while($row = $res->fetch_assoc())
                         {
  
                            echo '<li>';
                            echo '<figure>';
                            echo '<a class="aa-product-img" href="product-detail.php?detailid='.$row["product_id"].'"><img src="Admin/uploads/'.$row["image"].'" height=300 width=250 alt="'.$row["name"].' img"></a>';
                            echo '<a class="aa-add-card-btn addcart" href="#" data-productid="'.$row["product_id"].'"><span class="fa fa-shopping-cart"></span>Add To Cart</a>';
                            echo '<figcaption>';
                            echo '<h4 class="aa-product-title"><a href="#">'.$row["name"].'</a></h4>';
                            echo '<span class="aa-product-price">RS.'.$row["price"].'</span><span class="aa-product-price"></span>'; //<del>$65.50</del>
                            echo '<p class="aa-product-descrip">'.$row["description"].'</p>';
                            echo ' </figcaption>';
                            echo ' </figure> ';
                            echo '<div class="aa-product-hvr-content">';
                            echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>';
                            echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>';
                            echo '<a href="#" class="" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search search" data-id="'.$row["product_id"].'"></span></a>';                           
                            echo '</div>';
                          //product badge
                            echo '<span class="aa-badge aa-sale" href="#">SALE!</span>';
                            echo '</li>';        
                          }
                      }
                  }
                  
                  // This work when we do not choose any filter
                  else
                  {
                        $sql="SELECT * FROM products limit $start,$per_page";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0)
                        {
                            //echo("Data received");
                            while($row = $res->fetch_assoc()) {

                                echo '<li>';
                                echo '<figure>';
                                echo '<a class="aa-product-img" href="product-detail.php?detailid='.$row["product_id"].'"><img src="Admin/uploads/'.$row["image"].'" height=300 width=250 alt="'.$row["name"].' img"></a>';
                                echo '<a class="aa-add-card-btn addcart" href="#" data-productid="'.$row["product_id"].'"><span class="fa fa-shopping-cart"></span>Add To Cart</a>';
                                echo '<figcaption>';
                                echo '<h4 class="aa-product-title"><a href="#">'.$row["name"].'</a></h4>';
                                echo '<span class="aa-product-price">RS.'.$row["price"].'</span><span class="aa-product-price"></span>'; //<del>$65.50</del>
                                echo '<p class="aa-product-descrip">'.$row["description"].'</p>';
                                echo ' </figcaption>';
                                echo ' </figure> ';
                                echo '<div class="aa-product-hvr-content">';
                                echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>';
                                echo '<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>';
                                echo '<a href="#" class="" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search search" data-id="'.$row["product_id"].'"></span></a>';                           
                                echo '</div>';
                              //product badge
                                echo '<span class="aa-badge aa-sale" href="#">SALE!</span>';
                                echo '</li>';        
                              }

                        }
                        else
                        {
                          header("Location:product.php?page=1");
                        }
                    }



            }
                   
               ?>
                  
              </ul> 
               
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                      <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">

                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <!-- <img src="img/view-slider/thumbnail/polo-shirt-1.png"> -->
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <!-- <img src="img/view-slider/thumbnail/polo-shirt-3.png"> -->
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <!-- <img src="img/view-slider/thumbnail/polo-shirt-4.png"> -->
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3 class="qname"></h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price qprice"></span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p class="qdesc"></p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                            <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>



                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
              <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php
                  for($i=1;$i<=$no_of_page;$i++)
                  {
                   
                    if($page==$i)
                    {
                      
                    }
                    echo '<li><a href="product.php?page='.$i.'">'.$i.'</a></li>';
                     
                  }
                  ?>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <a href="product.php" style="color:red;margin-top:15px; font-size:25px;">Clear All Filters</a>
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                <?php
                  $sql="SELECT DISTINCT category FROM products ORDER BY category";
                  $result = $conn->query($sql);
                  while($row=$result->fetch_assoc()){
                    echo '<li ><a href="product.php?cat='.$row["category"].'">'.$row["category"].'</a></li>';
                  }
                ?>                
              </ul>
            </div>

            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
              <?php
                  $sql="SELECT DISTINCT(tag_name) FROM tags ORDER BY tag_name";
                  $result = $conn->query($sql);
                  while($row=$result->fetch_assoc()){
                    echo '<a href="product.php?tag='.$row["tag_name"].'">'.$row["tag_name"].'</a>';
                    // echo '<a href="product-detail.php">'.$row["tag_name"].'</a>';
                  }
                ?>
               
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <a class="aa-color-green" href="#"></a>
                <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img qimage"><img alt="img" src=""></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->

<?php include('dsfooter.php'); ?>

<script>
      $(document).ready(function(){
          $(".search").click(function(){
            var id=$(this).data('id');
            $.ajax({
              method:"POST",
              url:"quick_view.php",
              data: {id : id},
              dataType:"json"

            })
            .done(function( msg ) {
              $('.qname').html(msg.product.name);
              $('.qprice').html(msg.product.price);
              $('.qdesc').html(msg.product.description);
              $('.simpleLens-lens-image').html('<img src="Admin/uploads/'+msg.product.image+'" height="300" width="250" >')
              $('.simpleLens-thumbnail-wrapper').html('<img src="Admin/uploads/'+msg.product.image+'" height="70" width="50" >')
            });
          });
          
          
          $(".addcart").click(function(){
            var productid=$(this).data('productid');
            //alert("hey "+productid);
            $.ajax({
            method:"POST",
            url:"cartprocess.php",
            data: {productid : productid},
            dataType:"json"

          })
          .done(function( msg ) {
              $('.aa-cart-notify').html(msg);
            // $('.aa-cart-notify').html(msg.cartArray.header_no);
            // console.log(msg.cartArray.header_no);
            // console.log(msg.cartArray.cart_products);
           
          });
        });
      });
</script>