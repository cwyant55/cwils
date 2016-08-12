<?php 
// Page title
$title = "Patron Lookup";
require(dirname(__FILE__) . "/Include/header.php");
?>

<!-- extra head tags -->
<script src="../js/magic.js"></script>
<?php require(dirname(__FILE__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Patron Lookup</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
		<form action="process.php" method="POST" id="patron-lookup" class="process">
        <div id="name-group" class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Henry Pym">
            <!-- errors will go here -->
        </div>
	
		<div id="barcode-group" class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" placeholder="0000X">
            <!-- errors will go here -->
        </div>
       
		
		<!-- Required fields to POST -->
		<input type="hidden" name="requiredor" value="name,barcode">
		<input type="hidden" name="formtype" value="patron-lookup">

       <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>

	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__FILE__) . "/Include/footer.php"); ?>