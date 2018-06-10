
<?php require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/header.php"; ?>
	<script type="text/javascript">
		
		function showSuggestion(str, optradio)
		{
	
			if(str.length == 0)
			{
				document.getElementById('output').innerHTML = '';
			}
			else
			{
				//AJAX REQ
				     var xmlhttp = new XMLHttpRequest();
				     xmlhttp.onreadystatechange = function(){
					 if(this.readyState == 4 && this.status == 200) {
						 document.getElementById('output').
						  innerHTML = this.responseText;
                          //console.log('str = ' + str + '; optradio = ' + optradio); 						  
					 } else {
						//console.log('failed connection'); 
				     }
						
					}
				 
					xmlhttp.open("GET", "suggest.php?q="+str+"&t="+optradio, true);
					xmlhttp.send();
			}
		}
	
	</script>
	<div class="container">
	    <h1 align="center">Current Contacts</h1>
		
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" style="margin: 1%; text-align: center;">
			<div class="form-check-inline">
			  <label class="form-check-label" for="radio1">
				<input type="radio" class="form-check-input" id="radio1" name="optradio" value="name">Name
			  </label>
			</div>
			<div class="form-check-inline">
			  <label class="form-check-label" for="radio2">
				<input type="radio" class="form-check-input" id="radio2" name="optradio" value="birthday">Birthday
			  </label>
			</div>
			<div class="form-check-inline">
			  <label class="form-check-label" for="radio3">
				<input type="radio" class="form-check-input" id="radio3" name="optradio" value="contactCode">Contact Code
			  </label>
			</div>
			<div class="form-check-inline">
			  <label class="form-check-label" for="radio5"> 
				<input type="radio" class="form-check-input" id="radio5" name="optradio" value="targetDate">Target Date
			  </label>
			</div>
			<div class="form-check-inline">
			  <label class="form-check-label" for="radio5"> 
				<input type="radio" class="form-check-input" id="radio5" onclick="showSuggestion('test',optradio.value)" name="optradio" value="all">Show All
			  </label>
			</div>
			<br>
			<input type="text" id="query-record" onkeyup="showSuggestion(this.value,optradio.value)" style="margin: 1%;" placeholder="Begin Typing Text Here To View Data" class="form-control">
			<!--<p>Suggestions: <span id="output" style="font-weight: bold;"></span></p>-->
		</form>
	
	<div class="table-responsive">
		<p id="selectedNameDisplay" align="center" style="color: red; font-size: 20px;"><i>Please select a contact below</i></p>
			<table class="table" id="output" style="text-align:center;"></table>
		
	  </div>
	
  </div>
   
<?php require $_SERVER["DOCUMENT_ROOT"]."/SocialContact/includes/footer.php"; ?>