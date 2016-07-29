<?php require "login/loginheader.php"; 
include "Include/dbconn.php";
?>

<?php 
	$res = db_query("SELECT * FROM `members`");
		if($res === false) {
		$error = db_error();
}
$members = mysqli_num_rows($res);
?>

<?php 
	$res = db_query("SELECT * FROM `stats`");
		if($res === false) {
		$error = db_error();
}
$stats = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
	<style>
	.chart div {
  font: 10px sans-serif;
  background-color: steelblue;
  text-align: right;
  padding: 3px;
  margin: 1px;
  color: white;
}
</style>
  </head>
  <body>
	<div class="chart"></div>
<script src="//d3js.org/d3.v3.min.js"></script>
<script>

var data = [<?php echo $members;?>, <?php echo $stats;?>];

var x = d3.scale.linear()
    .domain([0, d3.max(data)])
    .range([0, 420]);

	d3.select(".chart")
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d; });

</script>
  </body>
</html>
