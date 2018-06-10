<?php
   
    //include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
   
    //Create object Contact_Map
	$contact = new Contact_Map;
   
   //check for submit
	if(isset($_POST['delete']))
	{
		
		//Get form data
		$delete_ID = htmlspecialchars($_POST['delete_id']);
		
		$contact->deleteRecord($delete_ID);
	} 
	else if(isset($_POST['contacted']))
	{
		//record is ready to be updated
		
		//pull post variables
		$id = htmlspecialchars($_POST['id']);
		$name = htmlspecialchars($_POST['name']);
		$birthday = htmlspecialchars($_POST['birthday']);
		$contactCode = htmlspecialchars($_POST['contactCode']);
		$targetDate = htmlspecialchars($_POST['targetDate']);
		$description =  htmlspecialchars($_POST['description']);
		
		//update record for contacted user
		$contact->updateRecord($id, $name, $birthday, $contactCode, $targetDate, $description);
		
		//re-direct to homepage
		//header('Location: http://localhost/SocialContact/');
		
	}

   //pull specific ID from page parameter
   $id = $_GET['id'];
   
   //return contact
   $post = $contact->returnSpecifiedContact($id);
?>

    <?php require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/header.php"; ?>
        <div class="container">
			<div class="row">
				<div class="col-lg-6" style="text-align:left; font-size: 25px;">
				
					<h1 align="center"><?php echo $post['name'];?></h1>
							<small><b>Birthday:</b> <?php echo $post['birthday'];?> <br>
								   <b>Contact Source:</b> <?php echo $post['contactCode']; ?>
								   <p>
										<b>Target Date:</b>  <?php echo '<i>'.$post['targetDate'].'</i>'; ?> <br>
										<b>Notes:</b>  <?php echo '<i>'.$post['description'].'</i>'; ?> <br>
								   </p>
				</div>  
				<div class="col-lg-6" style="text-align:center; font-size: 25px;">
								   
								   <form class="pull-right" method="POST" action="<?php echo 'http://localhost/SocialContact/post.php?id='.$post['id'].'' ?>">
											<label><b>Update Target Date:</b></label>
											<div class="form-group">
												<input type="text" required name="targetDate" placeholder="Select 'Contacted' to change TargetDate" class="form-control">
											</div>
								        <!-- Values ready to be re-submitted -->
										<input type="hidden" name="id" value="<?php echo $post['id'] ?>">
										<input type="hidden" name="name" value="<?php echo $post['name'] ?>">
										<input type="hidden" name="birthday" value="<?php echo $post['birthday'] ?>">
											<!-- purposely leave out targetDate, its being updated -->
										<input type="hidden" name="contactCode" value="<?php echo $post['contactCode'] ?>">
										<input type="hidden" name="description" value="<?php echo $post['description'] ?>">
								   
										<!-- Link back to previous page -->
										<a class="btn btn-secondary" href="<?php echo 'http://localhost/SocialContact/php/modify.php'; ?>">Back</a>
										
										<!-- Edit this post -->
										<a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id'] ?>" class="btn btn-primary">Edit</a>
										
										<!-- update target -->
										<input type="submit" name="contacted" value="Contacted" class="btn btn-success">
								   </form>
								 
							 </small>
					    <hr>
						
						<form class="pull-right" method="POST" action="<?php echo 'http://localhost/SocialContact/post.php?id='.$post['id'].'' ?>">
										<!-- Delete this post -->
								<input type="hidden" name="delete_id" value="<?php echo $post['id'] ?>">
								<input type="submit" style="width: 100%;" name="delete" value="Delete" class="btn btn-danger">
						</form>
						
						<br>
						
				</div>		
			</div>
		</div>
		
	<?php require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/footer.php"; ?>

