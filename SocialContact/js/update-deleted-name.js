function updateDeleted(contactName)
{
	//adjust contact name that'll be sent to the database
	document.getElementById("selectedName").innerHTML = contactName;
	
	alert(contactName + ' has been selected- scroll down, and select \'Submit\' in order to complete this transaction.');
	
	//adjust red label stating selected user to delete
	document.getElementById("selectedNameDisplay").innerHTML =  '<b>' + contactName + '</b> has been selected- scroll down, and select <b>Submit</b> in order to complete this transaction.';
}