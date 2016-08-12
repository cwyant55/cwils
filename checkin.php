<?php 
// Page title
$title = "Checkin";
require(dirname(__FILE__) . "/Include/header.php");
?>

<!-- more head tags -->
<script src="../js/magic.js"></script>
<?php require(dirname(__FILE__) . "/Include/nav.php"); ?>

	<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Item Checkin</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
		<form action="process.php" method="POST" id="checkin" class="process">
	
		<div id="barcode-group" class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" placeholder="0000X">
            <!-- errors will go here -->
        </div>
       
		<!-- Required fields to POST -->
		<input type="hidden" name="required" value="barcode">
		<input type="hidden" name="formtype" value="checkin">

       <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>

	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->

<?php require(dirname(__FILE__) . "/Include/footer.php"); ?>