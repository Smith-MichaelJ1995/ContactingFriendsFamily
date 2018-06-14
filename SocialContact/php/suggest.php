<?php

	//include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
	
	//Create object Contact_Map
	$contact = new Contact_Map;
	
	//retrieve all records for display
	$currentContactList = $contact->retAllRecords();
	
	
	//get query string
	$q = $_REQUEST['q'];
	$o = $_REQUEST['t'];
	
	//TEST DATA SENT TO SERVER PAGE
	//echo 'text query = '.$q;
	//echo 'radio option = '.$o;
	
	
	
	
	//instantiate suggestion string
	$suggestion = "";
	
	// Get Suggestions
   if($q !== "" && $o !== ""){
	   
	   //convert query string to lowercase
	   $q = strtolower($q);  
	   $len = strlen($q);
	   
	   //allows us to print tr's appropriately
		$rowCount = 0;
		   
	   
	   //traverse through list of contacts
	   foreach($currentContactList as $ccListOBJ){
		   
		   switch ($o) {
				case "name":
					   if(stristr($q, substr($ccListOBJ['name'], 0, $len)))  //stristr finds first occurance of string in an array
					   {   
					       //print <tr>
						   if($rowCount % 3 == 0){$suggestion .= '<tr>';}
						  
						   $suggestion .= '<td style="text-align:center;"> <h3>'.$ccListOBJ['name'].'</h3><small><b>Birthday:</b>'. $ccListOBJ['birthday'].' <br>
						   <b>Contact Source:</b> '.$ccListOBJ['contactCode'].'
						   <p style="text-align:center;">
								<b>Target Date:</b> '.$ccListOBJ['targetDate'].' <br>
						   </p>
						    
							<a class="btn btn-secondary" style="width:100%;" href="'.ROOT_URL.'post.php?id='.$ccListOBJ['id'].'">
								<button type="button" class="btn btn-secondary" align="center">Select: '.$ccListOBJ['name'].' </button>
							</a> </small></td>';
							
							//print <tr> tag if neccessary
						   if($rowCount % 3 == 2){$suggestion .= '</tr>';}
						   
						   //increment row counter
						   $rowCount++;
						
						
					   }
					break;
				case "birthday":
					   //acquire birthday month + day for this record
					   $dateArr = explode('-', $ccListOBJ['birthday']);
					   
					   if(stristr($q, substr($dateArr[1], 0, $len)))  //stristr finds first occurance of string in an array
					   {
						   //print <tr>
						   if($rowCount % 3 == 0){$suggestion .= '<tr>';}
						  
						   $suggestion .= '<td style="text-align:center;"> <h3>'.$ccListOBJ['name'].'</h3><small><b>Birthday:</b>'. $ccListOBJ['birthday'].' <br>
						   <b>Contact Source:</b> '.$ccListOBJ['contactCode'].'
						   <p style="text-align:center;">
								<b>Target Date:</b> '.$ccListOBJ['targetDate'].' <br>
						   </p>
						    
							<a class="btn btn-secondary" style="width:100%;" href="'.ROOT_URL.'post.php?id='.$ccListOBJ['id'].'">
								<button type="button" class="btn btn-secondary" align="center">Select: '.$ccListOBJ['name'].' </button>
							</a> </small></td>';
							
							//print <tr> tag if neccessary
						   if($rowCount % 3 == 2){$suggestion .= '</tr>';}
						   
						   //increment row counter
						   $rowCount++;
							
					   }
					break;
				case "contactCode":
					   if(stristr($q, substr($ccListOBJ['contactCode'], 0, $len)))  //stristr finds first occurance of string in an array
					   {
						   //print <tr>
						   if($rowCount % 3 == 0){$suggestion .= '<tr>';}
						  
						   $suggestion .= '<td style="text-align:center;"> <h3>'.$ccListOBJ['name'].'</h3><small><b>Birthday:</b>'. $ccListOBJ['birthday'].' <br>
						   <b>Contact Source:</b> '.$ccListOBJ['contactCode'].'
						   <p style="text-align:center;">
								<b>Target Date:</b> '.$ccListOBJ['targetDate'].' <br>
						   </p>
						    
							<a class="btn btn-secondary" style="width:100%;" href="'.ROOT_URL.'post.php?id='.$ccListOBJ['id'].'">
								<button type="button" class="btn btn-secondary" align="center">Select: '.$ccListOBJ['name'].' </button>
							</a> </small></td>';
							
							//print <tr> tag if neccessary
						   if($rowCount % 3 == 2){$suggestion .= '</tr>';}
						   
						   //increment row counter
						   $rowCount++;
						
						
					   }
					break;
				case "targetDate":
					if(stristr($q, substr($ccListOBJ['targetDate'], 0, $len)))  //stristr finds first occurance of string in an array
					   {
						   //print <tr>
						   if($rowCount % 3 == 0){$suggestion .= '<tr>';}
						  
						   $suggestion .= '<td style="text-align:center;"> <h3>'.$ccListOBJ['name'].'</h3><small><b>Birthday:</b>'. $ccListOBJ['birthday'].' <br>
						   <b>Contact Source:</b> '.$ccListOBJ['contactCode'].'
						   <p style="text-align:center;">
								<b>Target Date:</b> '.$ccListOBJ['targetDate'].' <br>
						   </p>
						    
							<a class="btn btn-secondary" style="width:100%;" href="'.ROOT_URL.'post.php?id='.$ccListOBJ['id'].'">
								<button type="button" class="btn btn-secondary" align="center">Select: '.$ccListOBJ['name'].' </button>
							</a> </small></td>';
							
							//print <tr> tag if neccessary
						   if($rowCount % 3 == 2){$suggestion .= '</tr>';}
						   
						   //increment row counter
						   $rowCount++;
					   }
					break;
				case "all":
					 //show all records
					   //print <tr> tag if neccessary
						   //print <tr>
						   if($rowCount % 3 == 0){$suggestion .= '<tr>';}
						  
						   $suggestion .= '<td style="text-align:center;"> <h3>'.$ccListOBJ['name'].'</h3><small><b>Birthday:</b>'. $ccListOBJ['birthday'].' <br>
						   <b>Contact Source:</b> '.$ccListOBJ['contactCode'].'
						   <p style="text-align:center;">
								<b>Target Date:</b> '.$ccListOBJ['targetDate'].' <br>
						   </p>
						    
							<a class="btn btn-secondary" style="width:100%;" href="'.ROOT_URL.'post.php?id='.$ccListOBJ['id'].'">
								<button type="button" class="btn btn-secondary" align="center">Select: '.$ccListOBJ['name'].' </button>
							</a> </small></td>';
							
							//print <tr> tag if neccessary
						   if($rowCount % 3 == 2){$suggestion .= '</tr>';}
						   
						   //increment row counter
						   $rowCount++;
						
					break;
				default:
					//echo "Your favorite color is neither red, blue, nor green!";
			}
			
	   }
   }

   
   echo $suggestion === "" ? "No Suggestion" : $suggestion;

?>