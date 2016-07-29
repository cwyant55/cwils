<?php 
// Page title
$title = "Home";
require "Include/header.php";
 ?>
 
<?php 
$res = db_query("SELECT * FROM `patrons`");
	if($res === false) {
	$error = db_error();
}
$patrons = mysqli_num_rows($res);
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
			text: "Simple Column Chart"
		},
		data: [
		{
			type: "column", //change type to bar, line, area, pie, etc
			dataPoints: [
				{ label: "Yesterday", y: <?php print($patrons); ?> },
				{ label: "Today", y: 55 },
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