<?php

	//include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
	
	//Create object Contact_Map
	$contact = new Contact_Map;
	
	//check for submit
	if(isset($_POST['submit']))
	{
		
		//Get form data
		$update_ID = htmlspecialchars($_POST['update_id']);
		$name = htmlspecialchars($_POST['name']);
		$birthday = htmlspecialchars($_POST['birthday']);
		$contactCode = htmlspecialchars($_POST['contactCode']);
		
		$targetDate = htmlspecialchars($_POST['targetDate']);
		$description =  htmlspecialchars($_POST['description']);
		
		//fetch the controller class, adjust the model
		$contact->updateRecord($update_ID, $name, $birthday, $contactCode, $targetDate, $description);
		
		header('Location: http://localhost/SocialContact/post.php?id='.$update_ID.'');
		
	}
	
	//pull specific ID from page parameter
	$id = $_GET['id'];
	   
	//return contact
	$post = $contact->returnSpecifiedContact($id);
	
?>

<?php include('includes/header.php'); ?>
	<div class="container">
			<h1>Edit Contact Information: <?php echo $post['name']?> </h1>
			 <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			    <div class="form-group">
							<label>Name</label>
							<input type="text" required name="name" value="<?php echo $post['name'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Birthday</label>
					<input type="text" required name="birthday" value="<?php echo $post['birthday'] ?>" placeholder="YYYY-MM-DD" class="form-control">
				</div>
				<div class="form-group">
					<label for="sel1">How Do You Know This Person (Contact Code):</label>
						 <select required name="contactCode" class="form-control">
							<option <?php echo ($post["contactCode"] === "Family Member")?"selected" : ""; ?> >Family Member</option>
							<option <?php echo ($post["contactCode"] === "Childhood/Hometown")?"selected" : ""; ?> >Childhood/Hometown</option>
							<option <?php echo ($post["contactCode"] === "College")?"selected" : ""; ?> >College</option>
							<option <?php echo ($post["contactCode"] === "Girlfriend")?"selected" : ""; ?> >Girlfriend</option>
							<option <?php echo ($post["contactCode"] === "Work/Co-worker")?"selected" : ""; ?> >Work/Co-worker</option>
							<option <?php echo ($post["contactCode"] === "Religion")?"selected" : ""; ?> >Religion</option>
							<option <?php echo ($post["contactCode"] === "Other")?"selected" : ""; ?> >Other</option>
						 </select>
				</div>
				<!--
				<div class="form-group">
					<label for="sel1">How Long Until Contacting This Person (Timespan):</label>
						  <select required name="timespan" value="<?php // echo $post['timespan'] ?>" class="form-control">
							<option>1 day</option>
							<option>3 days</option>
							<option>7 days</option>
							<option>10 days</option>
							<option>2 weeks</option>
							<option>3 weeks</option>
							<option>4 weeks</option>
							<option>6 weeks</option>
							<option>1 month</option>
							<option>2 months</option>
							<option>3 months</option>
							<option>4 months</option>
							<option>5 months</option>
							<option>6 months</option>
							<option>7 months</option>
							<option>8 months</option>
							<option>9 months</option> 
							<option>10 months</option>
							<option>11 months</option> 
							<option>1 year</option>
							<option>18 months</option>
							<option>2 years</option>
						  </select>
				</div>
				-->
				<div class="form-group">
							<label>Target Date</label>
							<input type="text" required name="targetDate" value="<?php echo $post['targetDate'] ?>" placeholder="Ex: May 25 1995 (when to contact this person)" class="form-control">
				</div>
				<div class="form-group">
							<label>Description</label>
							<textarea id="description" required name="description" placeholder="Important information about this person (avoid using ' character)" class="form-control"></textarea>
				</div>
					<input type="hidden" name="update_id" value="<?php echo $post['id'] ?>" class="btn btn-primary">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			 </form>
	</div>
<?php include('includes/footer.php'); ?>

<!-- javascript to set textarea content -->
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("description").innerHTML = '<?php echo $post['description'] ?>';
	});
</script>