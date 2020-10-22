
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
	$description=isset($_POST['description'])?$_POST['description']:'';
	$filetempname=$_FILES['file']['tmp_name'];
	$imagedestination='uploads/'.$imagename;
	move_uploaded_file($filetempname,$imagedestination);
	//accessing each tag
	$tag=implode(",", $_POST['tags']);
	
	$sql='INSERT INTO products(`name`,`price`,`image`,`category`,`tags`,`description`)VALUES("'.$name.'","'.$price.'","'.$imagename.'","'.$category.'","'.$tag.'","'.$description.'")';
        if ($conn->query($sql) === TRUE) {
			$message="New record created successfully";
		}
		else {
            $errors=array('input'=>'form','msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }        
       
	}			

    if(isset($_GET['orderid']))
    {
        $id=$_GET['orderid'];
        //echo $_GET['orderid'];
    
        $sql = "DELETE FROM orders WHERE `order_id`='$id'";
    
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
						<!-- <li><a href="#tab2">Add</a></li> -->
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
								   <th>ORDER ID</th>
								   <th>PRODUCT ID</th>
								   <th>CART DATA</th>
								   <th>TOTAL PRICE</th>
								   <th>STATUS</th>
								   <th>DATETIME</th>
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
									$sql = "SELECT * FROM orders";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											
											echo '<tr><td><input type="checkbox" /></td>';																					echo "<td>".$row["order_id"]."</td>";
											echo "<td>".$row["product_id"]."</td>";
											echo "<td>".$row["cart_data"]."</td>";
											echo "<td>$".$row["total"]."</td>";
											echo "<td>".$row["status"]."</td>";
											echo "<td>".$row["datetime"]."</td>";
											echo "<td>";
											echo '<a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>';
										 	echo '<a href="orders.php?orderid='.$row["order_id"].'" onclick="return checkdelete('.$row["order_id"].')" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>';
											echo "</td></tr>";
										}
									} else {
										echo "0 results";
									}
								?>
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
					
				</div> <!-- End .content-box-content -->                  
				
			</div> <!-- End .content-box -->

			<div class="clear"></div>

			<script>
				function checkdelete(id){
					return confirm("Are you sure you want to delete the order no. " + id+ "??")
				}
			</script>
		
			
	<?php include('footer.php'); ?>