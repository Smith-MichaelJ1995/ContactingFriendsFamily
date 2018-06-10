 //Change date & update time 
	setInterval(function() {
			// method to be executed;
			var now = new Date();
			
			document.getElementById("datetime").innerHTML = now;
	}, 1000);