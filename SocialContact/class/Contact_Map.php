<?php
  /* 1) contains an associative array mapping string time to integer seconds.
	 2) method that:
		- selects all records from database & iterates through them.
		- calls function that traverses assoc array and returns corresponding int second value
		- stores current date in a variable.
		
		-foreach record, add variable to another list iff (current time > targetDate && todays month-day == records month-day) 
		- if so, add it to an array.
		
		To Concider: make a change to timespan via Update.php, and targetDate is recalculated.
		
	3) Create targetDate method (Used three times - once in insert, when the person has been contacted and it's time to start again [check box],
	and when you UPDATE the timespan  )
	   - convert timespan var to seconds, as well as current time.
	   - add two together and this is targetDate
	   - convert second value back to date format, return new string.
	   

  */
	//set default date and time
	date_default_timezone_set('America/New_York');
	
  
   class Contact_Map
   {
	   	   
	   public function __construct () {
		   //set ROOT_URL Variables
			define('ROOT_URL','http://localhost/SocialContact/');
	   }
	   
	   //return ROOT URL Root URL variable
	   function returnROOT_URL()
	   {
		   return $this->ROOT_URL;
	   }
	   
	   function openDBConnection()
	   {
			// Create Connection
		    $conn = mysqli_connect('localhost', 'root', '61RandolphDrive', 'contactfriends');
		   
		   // Check Connection
		   if(mysqli_connect_errno())
		   {
			  // Connection Failed
			  echo 'Failed to connect to MYSQL '. mysqli_connect_errno();
		   }
		   
		   return $conn;
		   
	   }
	   
	   //convert to string birthday input to numerical date
	   function convertStringDate($bString)
	   {   
			//date now in proper format for database entry
		    return date('Y-m-d', strtotime($bString));
			
	   }
	   

	   //return target date based on timespan & current date
       function createTargetDate($tspan)
	   {
		   return date('Y-m-d', strtotime('+'.$tspan.''));
       }
	   
	   function insertRecord($name,$birthday,$contactCode,$targetDate,$description)
	   {
		   //open database connection
		   $conn = $this->openDBConnection();
		   
		   //convert birthday into proper DB format
		   $bDayInput = $this->convertStringDate($birthday);
		   
		   //convert targetDate into proper DB format
		   $tDateInput = $this->convertStringDate($targetDate);
		   //process target date based on current date and timespan
			//$targetDate = $this->createTargetDate($timespan);
			
		   //create SQL query
			$query = "INSERT INTO contacts(name, birthday, contactCode, targetDate, description) VALUES('$name', '$bDayInput','$contactCode','$tDateInput','$description')";
			
			if(mysqli_query($conn, $query))
			{  
		       //notify of successful query
			   $page_link = "SELECT * FROM contacts WHERE name = '$name'";
		   
			   //Get result
			   $rec = mysqli_query($conn, $page_link);
			   
			   //Fetch result
			   $entries = mysqli_fetch_all($rec, MYSQLI_ASSOC);
			   
			   //re-direct to post page
			   //header('Location: http://localhost/SocialContact/post.php?id='.$entries['id'].'');;
			} 
		    else {
			   echo 'Error: '. mysqli_error($conn);	
			}
		   
		   
	   }
	   
	   //update specified record in database
	   function updateRecord($update_ID, $name, $birthday, $contactCode, $targetDate, $description)
	   {
		   //open database connection
		   $conn = $this->openDBConnection();
		   
		   //convert birthday into proper DB format
		   $bDayInput = $this->convertStringDate($birthday);
		   
		    //convert targetDate into proper DB format
		   $tDateInput = $this->convertStringDate($targetDate);
			
			//update record in database
			$query = "UPDATE contacts SET
             		name='$name', 
					birthday='$bDayInput',
					contactCode='$contactCode',
					targetDate='$tDateInput',
					description='$description'
		            WHERE id = {$update_ID}";
		
		    
			if(mysqli_query($conn, $query))
			{
				//echo '<script type="text/javascript">eval(alert("Success, '.$name.'\'s record has been updated. You will be notified on '.$this->createTargetDate($timespan).' to contact this person!"));</script>';
				//header('Location: http://localhost/SocialContact/php/modify.php');
			} else {
			   echo 'Error: '. mysqli_error($conn);	
			}
		   }

       //retrieve all records from database	  
       function retAllRecords()
       {
		   //open database connection
		   $conn = $this->openDBConnection();
		   
			//Create query
		   $query = 'SELECT * FROM contacts ORDER BY DAY(birthday)';
		   
		   //Get result
		   $result = mysqli_query($conn, $query);
		   
		   
		   //Fetch result
		   $entries = mysqli_fetch_all($result, MYSQLI_ASSOC);
		   
		   //close connection
		   mysqli_close($conn);
		   
		   //return entries
		   return $entries;
		 
	   }

       //delete a record from database
	   function deleteRecord($delete_ID)
	   {
		   $conn = $this->openDBConnection();
		   
		   $query = "DELETE FROM contacts WHERE id = {$delete_ID}";
		
		   if(mysqli_query($conn, $query))
		   {
				//redirect
				header('Location: http://localhost/SocialContact/php/modify.php');
		   } else {
			   echo 'Error: '. mysqli_error($conn);	
		   }
	   }
	   
	   function returnSpecifiedContact($id)
	   {
		   //open database connection
		   $conn = $this->openDBConnection();
		   
		   //Create query
		   $query = 'SELECT * FROM contacts WHERE id = '.$id;
		   
		   //Get result
		   $result = mysqli_query($conn, $query);
		   
		   //Fetch result
		   $record = mysqli_fetch_assoc($result);
		   
		   //Free Result
		   mysqli_free_result($result);
		   
		   //close connection
		   mysqli_close($conn);
		   
		   //return record
           return $record;		   
		   
	   }
	   
	   //return contacts for today
	   function returnTodayContacts()
	   {
		    //open database connection
		   $fullAddressBook = $this->retAllRecords();
		   
		   //print_r($fullAddressBook);
		   
		   //get today's date
		   $today = date("Y/m/d");
		   
		   //data structure to store today's contacts 
		   $todaysCTacts = array();
		   
		   foreach ( $fullAddressBook as $cTact ) {
			   
			   //acquire birthday month + day for this record
				$dateArr = explode('-', $cTact['targetDate']);
				//print_r($dateArr);
				
			   //acquire date for today
			    $todaysDate = explode('/', date('Y/m/d', strtotime($today)));
				//print_r($todaysDate);
				
				//if year is greater, than we must've passed the target date
				if($todaysDate[0] > $dateArr[0])
				{
					//therefore today has to be at, or past the target date!
					$todaysCTacts[] = $cTact;
				}
                else if($todaysDate[0] == $dateArr[0])
				{   
					//years are the same, compare months
					if($todaysDate[1] > $dateArr[1])
					{
						//therefore today has to be at, or past the target date!
						$todaysCTacts[] = $cTact;
					}
					else if($todaysDate[1] == $dateArr[1])
					{
						//months are the same, compare days
						if($todaysDate[2] >= $dateArr[2])
						{
							//therefore today has to be at, or past the target date!
							$todaysCTacts[] = $cTact;
						}
					}
				}				
		   }
			
		   //contact these people today
		   return $todaysCTacts;
				
	   }
	   
	   
	   //return birthday's for today
	   function returnTodayBirthdays()
	   {
		    //open database connection
		   $fullAddressBook = $this->retAllRecords();
		   
		   //get today's date
		   $today = date("Y/m/d");
		   
		   //data structure to store all birthday objects 
		   $birthdays = array();
		   
		   foreach ( $fullAddressBook as $cTact ) {
			   
			   //acquire birthday month + day for this record
				$dateArr = explode('-', $cTact['birthday']);
				
				
			   //acquire date for today
			    $todaysDate = explode('/', date('Y/m/d', strtotime($today)));
				
				//compare if month's match
				if($dateArr[1] == $todaysDate[1])
				{
					//compare if day's match
					if($dateArr[2] == $todaysDate[2])
					{
						//it's this persons birthday, add to list
						$birthdays[] = $cTact;
						//echo 'Happy Birthday: '. $cTact['name'];
					}
				}
				
		   }
		   
		   
		   
		   //return birthdays for today
			return $birthdays;
	   }
	   
	   //return timespan string
	   function returnTimespanString() {
		  
		   //return contact based on timespan, and birthday
		   $timespanRecords = $this->returnTodayContacts();
		   
		   //email string to be returned
		   $email_string = "";
		   
		   foreach($timespanRecords as $person){
		      $email_string .= "
				<tr>
					<td>".$person['name']."</td>
					<td>".$person['birthday']."</td>
					<td>".$person['timespan']."</td>
					<td>".$person['contactCode']."</td>
					<td>".$person['targetDate']."</td>
				</tr>
			  \n";
	       }
		   
		   //return print string
		   return $email_string;
	   }
	   
	    //return birthday string
	   function returnBirthdayString() {
		  
		   //birthday object
		   $birthdayRecords = $this->returnTodayBirthdays();
		   
		   //email string to be returned
		   $email_string = "";
		   
		   foreach($birthdayRecords as $person){
		      $email_string .= "
				<tr>
					<td>".$person['name']."</td>
					<td><p style=\"color: red;\">".$person['birthday']."</p></td>
					<td>".$person['timespan']."</td>
					<td>".$person['contactCode']."</td>
					<td>".$person['targetDate']."</td>
				</tr>
			  \n";
	       }
		   
		   //return print string
		   return $email_string;
		   
	   }
	   
   }
  
   

?>