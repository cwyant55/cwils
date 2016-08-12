<?php 
// Page title
$title = "Cataloging";
include(dirname(__DIR__) . "/Include/header.php");
?>

<!-- extra head tags -->
<?php require(dirname(__DIR__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Cataloging Home</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-4">
	<a href="new-item.php" class="btn btn-primary btn-lg btn-block">Create New Item</a>
	</div>
	<div class="container col-md-4">
	<a class="btn btn-default btn-lg btn-block">Edit Item</a>
	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__DIR__) . "/Include/footer.php"); ?>