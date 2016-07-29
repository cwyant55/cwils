<?php require "login/loginheader.php";
include "Include/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php print($title);?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
  </head>

<body>
	<div class="container"><!-- main container -->
	<div class="row">
	<div class="container col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
			Banner image or something will go here.
			</div>
		</div>
	</div>
	</div>
	<div class="row">
	<div class="container col-md-2"><!-- Main nav -->
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation" class="active"><a href="/index.php">Home</a></li>
		<li role="presentation"><a href="/registration.php">Patron Registration</a></li>
		<li role="presentation"><a href="#">Profile</a></li>
		<li role="presentation"><a href="#">Profile</a></li>
		<li role="presentation"><a href="#">Profile</a></li>
		<li role="presentation"><a href="login/logout.php">Logout</a></li>
	</ul>
	</div><!-- nav -->