<?php 
// Page title
$title = "Home";
require "Include/header.php";
 ?>
 
<?php // get # patrons
$res = db_query("SELECT * FROM `patrons`");
	if($res === false) {
	$error = db_error();
}
$patrons = mysqli_num_rows($res);
?>

<?php // get # patrons registered today
$res = db_query("SELECT * FROM `patrons` WHERE DATE(`timestamp`) = CURDATE()");
	if($res === false) {
	$error = db_error();
}
$today = mysqli_num_rows($res);
?>

<?php // get # patrons registered yesterday
$res = db_query("SELECT * FROM `patrons` WHERE DATE(`timestamp`) = CURDATE() - 1");
	if($res === false) {
	$error = db_error();
}
$yesterday = mysqli_num_rows($res);
?>


<div class="container col-md-8">
	<div class="jumbotron panel panel-default">
	<h1>Hey! How's it going?</h1>
	<p>Welcome to your new ILS.</p>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
	
<div id="chartContainer"></div>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		animationEnabled: true,
		title:{
			text: "New Patron Registrations"
		},
		data: [
		{
			type: "column", //change type to bar, line, area, pie, etc
			dataPoints: [
				{ label: "Yesterday", y: <?php print($yesterday); ?> },
				{ label: "Today", y: <?php print($today); ?> },
			]
		}
		]
	});

	chart.render();
}
</script>
	</div>
	
	</div>
</div>

</div><!-- end nav row -->

   
   
<?php require "Include/footer.php"; ?>