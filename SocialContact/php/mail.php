<?php
	//include functions on page
	require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/class/Contact_Map.php";
	
	//Create object Contact_Map
	$contact = new Contact_Map;
   
   
   //work on sending email
	$to = "michaeljoshuasmith1@gmail.com";
	$subject = "Birthdays Today: ". date("M d Y");
	$txt = '
	<html>
		<head>
		<title>HTML email</title>
		<style>
			
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
		
		</style>
		</head>
		<body>

		<h1>Today\'s Birthdays:</h1>
		<table style="border: 1px solid #000;">
			<tr>
				<th>Name</th>
				<th>Birthday</th>
				<th>Contact Code</th>
				<th>Target Date</th>
			</tr>
			'.$contact->returnBirthdayString().'
		</table>

			<br>

			<h1>Birthdays This Month:</h1>
			<table style="border: 1px solid #000;">
				<tr>
					<th>Name</th>
					<th>Birthday</th>
					<th>Contact Code</th>
					<th>Target Date</th>
				</tr>
				'.$contact->returnBirthdayMonthsString().'
			</table>
			
		</body>
	</html>';
	
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: testsender1995@gmail.com" . "\r\n";

	if( $contact->returnBirthdayString() != "" )
	{

		if(	mail($to,$subject,$txt,$headers) ) {
			
			echo 'BIRTHDAY TODAY: ', $contact->returnBirthdayString();

			echo '<h1><a href="http://localhost/SocialContact/php/updateDB.php">Download Database File</a></h1>';
			
			echo '<h1><a href="https://drive.google.com/drive/u/0/folders/1fu5UcVFs_XP3HT0h4PvfvytieAFAet4K?ogsrc=32">Google Drive Backup</a></h1>';
			
		
			//close page via javascript
			echo '<script>window.close();</script>';
		}
		else
		{
			echo 'ERROR';
		}
		
	}
	else
	{
		echo '<script>window.close();</script>';
	}
    

?>