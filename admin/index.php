<?php 
// Page title
$title = "Admin";
include(dirname(__DIR__) . "/Include/header.php");
?>

<!-- extra head tags -->
<?php require(dirname(__DIR__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Admin</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-4">
	<a href="http://192.168.33.10/8983/solr" class="btn btn-primary btn-lg btn-block">Apache Solr GUI</a>
	</div>
	<div class="container col-md-4">
	<a class="btn btn-default btn-lg btn-block">Item #2</a>
	</div>
	<div class="row">
		<div class="col-md-6">
		
<?php
$test = $_GET['search'];
$results = solrTest($test);

if ($results) { ?>
	<h2>Search results:</h2>
	<table class="table table-striped">
	<th>#</th><th>Title</th><th>Barcode</th>
<?php 
$i = 1;
foreach ($results as $result) {
	echo '<tr><td>' . $i . '</td><td><a href="#">' . $result['title'] . '</a></td><td>' . $result['id'] . '</td></tr>';
	$i++;
	
	} ?>
	</table>
<?php }
else {
	echo 'No results.';
}

?>
		</div>
	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__DIR__) . "/Include/footer.php"); ?>