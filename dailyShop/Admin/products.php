
<?php
include('config.php');
include('header.php');
include('sidebar.php');
 
if(isset($_POST['submit'])){
	$name=isset($_POST['name']) ? $_POST['name'] : '';
	$price=isset($_POST['price'])?$_POST['price']:'';
	//$imagename=isset($_POST['file'])?$_FILES['file']['name']:'';
	$category=isset($_POST['category'])?$_POST['category']:'';
	//$tags=$_POST['tags'];
	$imagename=$_FILES['file']['name'];
	$short_description=isset($_POST['short_description'])?$_POST['short_description']:'';
	$long_description=isset($_POST['long_description'])?$_POST['long_description']:'';
	$filetempname=$_FILES['file']['tmp_name'];
	$imagedestination='uploads/'.$imagename;
	move_uploaded_file($filetempname,$imagedestination);
	//accessing each tag
	$tag=implode(",", $_POST['tags']);
	$color=implode(",",$_POST['color']);

	$sql='INSERT INTO products(`name`,`price`,`image`,`category`,`color`,`tags`,`short_description`,`long_description`)VALUES("'.$name.'","'.$price.'","'.$imagename.'","'.$category.'","'.$color.'","'.$tag.'","'.$short_description.'","'.$long_description.'")';
        if ($conn->query($sql) === TRUE) {
			$message="New record created successfully";
		}
		else {
            $errors=array('input'=>'form','msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }        
       
	}			

if(isset($_GET['product_id']))
{
	$id=$_GET['product_id'];
	echo $_GET['product_id'];

	$sql = "DELETE FROM products WHERE `product_id`='$id'";

	if ($conn->query($sql) === TRUE) {
	echo "Record deleted successfully";
	} else {
	echo "Error deleting record: " . $conn->error;
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
			<h2>Welcome John</h2>
			
			<p id="page-intro">What would you like to do?</p>
	
			<div class="clear"></div> <!-- End .clear -->

			<div class="content-box"><!-- Start Content Box -->
				
				
				<div class="content-box-header">
					
					<h3>Content box</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div>
						
						<table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>Image</th>
								   <th>Name</th>
								   <th>Product-ID</th>
								   <th>Price</th>
								   <th>Category</th>
								   <th>Colors</th>
								   <th>Tags</th>
								   <th>Short Description</th>
								   <th>Long Description</th>
								   <th>Action</th>
								</tr>
								
							</thead>
						 
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<a class="button" href="#">Apply to selected</a>
										</div>
										
										<div class="pagination">
											<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
											<a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						 
							<tbody>

								<?php
									$sql = "SELECT * FROM products";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											
											echo '<tr><td><input type="checkbox" /></td>';
											echo '<td><img src="uploads/'.$row["image"].'"height="50" width="50"> </td>';	
											echo "<td>".$row["name"]."</td>";
											echo "<td>".$row["product_id"]."</td>";
											echo "<td>".$row["price"]."</td>";
											echo "<td>".$row["category"]."</td>";
											echo "<td>".$row["color"]."</td>";
											echo "<td>".$row["tags"]."</td>";
											echo "<td>".$row["short_description"]."</td>";
											echo "<td>".$row["long_description"]."</td>";
											echo "<td>";
											echo '<a href="updateproduct.php?name='.$row["name"].'&price='.$row["price"].'&category='.$row["category"].'&short_description='.$row["short_description"].'&product_id='.$row["product_id"].'" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>';
										 	echo '<a href="products.php?product_id='.$row["product_id"].'" onclick="return checkdelete()" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>';
											echo "</td></tr>";
										}
									} else {
										echo "0 results";
									}
								?>
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
					
						<form action="" method="POST" enctype="multipart/form-data">
						
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							
								<p>
									<label>Name</label>
									<input class="text-input medium-input" type="text" id="name" name="name" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
									<br /><small>Enter your name here</small>
								</p>
								
								<p>
									<label>Price</label>
									<input class="text-input small-input " type="text" id="price" name="price" /> <span class="input-notification error png_bg">Error message</span>   <!--datepicker-->
								</p>
								
								<p>
									<label>Image</label>
									<input type="file" name="file" id="file" accept="image/*">
								</p>
								
								<p>	
										<label>Category</label>         
										<select name="category" class="small-input">		
									<?php																				
										$cat_sql = "SELECT `name` FROM categories";
										$result = $conn->query($cat_sql);
										
										if ($result->num_rows > 0) {
										  // output data of each row
										  while($row = $result->fetch_assoc()) {
											echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
											
										  }
										} else {
										  echo "0 results, Manage categories first";
										}																		
									?>
									</select> 
								</p>

								<p>	
									<label>Tags</label>         		
									<?php																				
										$tag_sql = "SELECT `tag_name` FROM tags";
										$result = $conn->query($tag_sql);
										
										if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											echo '<input type="checkbox" name="tags[]" value="'.$row["tag_name"].'"/> '.$row["tag_name"];
											
										}
										} else {
										echo "0 results, Manage tags first";
										}																		
									?>
									
								</p>

								<p>	
									<label>Colors</label>         		
									<?php																				
										$color_sql = "SELECT `color` FROM colors";
										$result = $conn->query($color_sql);
										
										if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											echo '<input type="checkbox" name="color[]" value="'.$row["color"].'"/> '.$row["color"];
											
										}
										} else {
										echo "0 results, Manage tags first";
										}																		
									?>
									
								</p>
									
								<p>
									<label>Short Description</label>
									<textarea class="text-input textarea wysiwyg" id="short_description" name="short_description" cols="79" rows="15"></textarea>
								</p>

								<p>
									<label>Long Description</label>
									<textarea class="text-input textarea wysiwyg" id="long_description" name="long_description" cols="79" rows="15"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" name="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->

			<div class="clear"></div>

			<script>
				function checkdelete(){
					return confirm("Are you sure you want to delete this data??")
				}
			</script>
			<!-- Start Notifications -->
			<!--
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			-->
			<!-- End Notifications -->
			
	<?php include('footer.php'); ?>