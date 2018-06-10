<?php

	//include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
	
	//Create object Contact_Map
	$contact = new Contact_Map;
	
   //return contact based on timespan, and birthday
   $timespanRecords = $contact->returnTodayContacts();
   $birthdayRecords = $contact->returnTodayBirthdays();
   
?>	

<?php
  require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/header.php";  
?>


<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <h3>It's Time To Touch Base With:</h3>
		<table class="table">
			<thead>
			  <tr>
				<th>Name</th>
				<th>Contact Code</th>
				<th>Target Date</th>
				<th>Confirmed</th>
			  </tr>
			</thead>
			<tbody>
			    <!-- print timespan records from the database -->
				<?php
					//traverse through list of contacts
					foreach($timespanRecords as $person){
						
						//print record
						echo '
						<tr>
								<td>
									'.$person['name'].'
								</td>
								<td>
									<i>'.$person['contactCode'].'</i>
								</td>
								<td>
									<i>'.$person['targetDate'].'</i>
								</td>
								<td>
									<a href="http://localhost/SocialContact/post.php?id='.$person['id'].'"><button class="btn btn-primary" name="submit" style="width: 100%; height: 50%;">Contact</button></a>
								</td>
						</tr>';
					}
				?>
			</tbody>
        </table>
			<hr>
			
		<h3>Birthdays:</h3>
		<table class="table">
			<thead>
			  <tr>
				<th>Name</th>
				<th>Birthday</th>
				<th>Contact Source</th>
				<th>Confirmed</th>
			  </tr>
			</thead>
			<tbody>
				<!-- print birthday records from the database -->
				<?php
					//traverse through list of contacts
					foreach($birthdayRecords as $person){
						
						//print record
						//FIX THIS... LIKE OTHER 
						echo '
						<tr>
							<td>
								'.$person['name'].'
							</td>
							<td>
								<p style="color: red;">'.$person['birthday'].'</p>
							</td>
							<td>
								'.$person['contactCode'].'
							</td>
							<td>
								<a href="http://localhost/SocialContact/post.php?id='.$person['id'].'"><button class="btn btn-primary" name="submit" style="width: 100%; height: 50%;">Contact</button></a>
							</td>
							</form>
						</tr>';
					}
				?>
			</tbody>
        </table>
			<hr>
	
    </div>
    <div class="col-lg-6">
		   <h3>Add Contact</h3>
		  <p>Click the link below to add a new person to your contact book. The button below will link you to an entirely separate page.
		  On this page, you enter all of the fields that are needed for a new record. Most of the fields are very self explanatory - for example: we've added "Name", and "Date Of Birth".
		  The other three fields are: "Contact Code", "Timespan", and "TargetDate" The contact code is a numerical value the corresponds to the arena that connected you with this person (family, college, childhood) etc.
		  The timespan is the interval of time that you feel is an appropriate gap of time when it's appropriate to contact this person.	  </p>
		  <a href="http://localhost/SocialContact/php/insert.php"><button type="button" class="btn btn-primary" style="display: inline-block;">Add Records</button></a>
		  
		  <hr>
		  
		  <h3>Modify Contact</h3>
					<p>Select this button to perform various operations on the dataset. For example, you can can query the dataset by each of the database fields. 
				 For here, you can select a record that is within the returned dataset. This will re-direct you to another page, on this page, you can edit each of the field contents,
				 or you can simply delete the record from the database. 
			  </p>
				<a href="http://localhost/SocialContact/php/modify.php"><button type="button" class="btn btn-primary" style="display: inline-block;">Modify Records</button></a>
		  <hr>
    </div>
  </div>
</div> 


<?php
  require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/footer.php";
?>