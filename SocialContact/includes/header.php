<?php
	 //set default date and time
	date_default_timezone_set('America/New_York');
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Interation Consultation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Core Bootstrap CSS 4.1--> 
  <link rel="stylesheet" type="text/css" href="http://localhost/SocialContact/css/bootstrap.min.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="http://localhost/SocialContact/css/freelancer.css">

  
</head>
<body>

<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="http://localhost/SocialContact/">Michael Joshua Smith</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav"> 
	  <li class="nav-item">
        <a class="nav-link" href="http://localhost/SocialContact/php/insert.php">Insert</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/SocialContact/php/modify.php">Modify</a>
      </li>
    </ul>
  </div> 
</nav>

<div class="jumbotron text-center">
  <h1 id="datetime">Welcome To Michael's Application</h1>
  <p>Check below to see who you should reach out to today. Add, delete, update, and edit contacts in your book with the provided functions below.
</div>
