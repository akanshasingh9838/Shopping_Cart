<?php 
include('config.php');
include('header.php'); 
include('sidebar.php'); 
$id=$_GET['product_id'];
if(isset($_POST['submit'])){
    $name=isset($_POST['name']) ? $_POST['name'] : '';
	$price=isset($_POST['price'])?$_POST['price']:'';
    $description=isset($_POST['description'])?$_POST['description']:'';
    $category=$_POST['category'];
    $imagename=$_FILES['file']['name'];
	$filetempname=$_FILES['file']['tmp_name'];
	$imagedestination='uploads/'.$imagename;
	move_uploaded_file($filetempname,$imagedestination);
    $sql = "UPDATE products SET `name`='$name' , `price` ='$price' , `description`='$description',`image`='$imagename',`category`='$category' WHERE product_id='$id'";
   
    if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    } else {
    echo "Error updating record: " . $conn->error;
    }
}
?>
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome</h2>
			<p id="page-intro">UPDATE YOUR PRODUCT (Click on update button to save the changes)</p>
	
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Content box</h3>
					
	
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					
						
						<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div>
						
					
						<form action="" method="POST" enctype="multipart/form-data">
						
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                                   
								
								<p>
									<label>Name</label>
									<input class="text-input medium-input" type="text" value="<?php echo $_GET['name'];?>" id="name" name="name" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
									<br /><small>Enter your name here</small>
								</p>
								
								<p>
									<label>Price</label>
									<input class="text-input small-input " type="text" value="<?php echo $_GET['price'];?>" id="price" name="price" /> <span class="input-notification error png_bg">Error message</span>   <!--datepicker-->
								</p>
								
								<p>
									<label>Image</label>
									<input type="file" name="file" id="file" accept="image/*">
								</p>
								
								<p>
									<label>Category</label>              
									<select name="category" class="small-input">
										<option value="Men">Men</option>
										<option value="Women">Women</option>
										<option value="Kids">Kids</option>
										<option value="Electronics">Electronics</option>				
										<option value="Sports">Sports</option>
									</select> 
								</p>

								<!-- <p>
									<label>Tags</label>
									<input type="checkbox" name="tags[]" /> Fashion
									<input type="checkbox" name="tags[]" /> Ecommerce
									<input type="checkbox" name="tags[]" /> Shop
									<input type="checkbox" name="tags[]" /> HandBag
									<input type="checkbox" name="tags[]" /> Laptop
									<input type="checkbox" name="tags[]" /> Headphone
								</p> -->
																
								<p>
									<label>Description</label>
									<textarea class="text-input textarea wysiwyg" id="description" name="description" cols="79" rows="15" ><?php echo $_GET['description'];?></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" name="submit" value="Update" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					     
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->

			<div class="clear"></div>
	
			
	<?php include('footer.php'); ?>