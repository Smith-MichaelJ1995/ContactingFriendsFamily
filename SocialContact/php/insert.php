<?php

	//include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
	
	//Create object Contact_Map
	$contact = new Contact_Map;
	
	//check for submit
	if(isset($_POST['submit']))
	{

		//process form inputs
        $name = htmlspecialchars($_POST['name']);	
		$birthday =  htmlspecialchars($_POST['birthday']);
		//$timespan =  htmlspecialchars($_POST['timespan']);
		$contactCode =  htmlspecialchars($_POST['contactcode']);
		$targetDate = htmlspecialchars($_POST['targetDate']);
		$description =  htmlspecialchars($_POST['description']);

		//insert records to database
		$contact->insertRecord($name, $birthday, $contactCode, $targetDate, $description);

		/*if (new DateTime() > new DateTime("2018-05-16")) {
			echo 'It works';
		}*/
 	
	}
		
?>
<?php 
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/header.php";
?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3>Add A New Friend</h3>
				<p>Click the link below to add a new person to your contact book. The button below will link you to an entirely separate page.
		  On this page, you enter all of the fields that are needed for a new record. Most of the fields are very self explanatory - for example: we've added "Name", and "Date Of Birth".
		  The other three fields are: "Contact Code", "Timespan", and "TargetDate" The contact code is a numerical value the corresponds to the arena that connected you with this person (family, college, childhood) etc.
		  The timespan is the interval of time that you feel is an appropriate gap of time when it's appropriate to contact this person.	  </p>
		  
		  
				<?php
					if(isset($_POST['submit']))
					{
						echo "<p style=\"color: red;\"><i>Successful Submission: <b>".$name."</b> is now a contact!</i></p>";
					}
				?>
		  
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
					 <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" style="margin: 1%;">
						<div class="form-group">
							<label>Name</label>
							<input type="text" required name="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Birthday</label>
							<input type="text" required name="birthday" placeholder="Ex: August 18 1995" class="form-control">
						</div>
						<div class="form-group">
						  <label for="sel1">How Do You Know This Person (Contact Code):</label>
						  <select required name="contactcode" class="form-control">
							<option>Family Member</option>
							<option>Childhood/Hometown</option>
							<option>College</option>
							<option>Girlfriend</option>
							<option>Work/Co-worker</option>
							<option>Religion</option>
							<option>Other</option>
						  </select>
						</div>
						<!--
						<div class="form-group">
							<label for="sel1">How Long Until Contacting This Person (Timespan):</label>
						  <select required name="timespan" class="form-control">
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
							<input type="text" required name="targetDate" placeholder="Ex: May 25 1995 (when to contact this person)" class="form-control">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea required name="description" placeholder="Important information about this person" class="form-control"></textarea>
						</div>
						
						
						<!-- JS to display the different options based on radio selection -->
						
						<input type="submit" name="submit" value="Submit" class="btn btn-primary">
					</form>
			</div>
		</div>
	  </div>
<?php
    require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/footer.php";
?>