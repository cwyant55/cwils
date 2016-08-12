<?php 
// Page title
$title = "Create New Item";
include(dirname(__DIR__) . "/Include/header.php");
?>

<!-- extra head tags -->
<script src="../js/magic.js"></script>
<?php require(dirname(__DIR__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Create New Item</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
		<form action="../process.php" method="POST" id="new-item" class="process">
        <div id="title-group" class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Moby Dick">
            <!-- errors will go here -->
        </div>

        <!-- Barcode -->
        <div id="barcode-group" class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" placeholder="0000X">
            <!-- errors will go here -->
        </div>
		
		 <!-- Checkout Length -->
        <div id="checkoutlength-group" class="form-group">
            <label for="checkoutlength">Checkout Length</label>
            <select class="form-control" name="checkoutlength">
				<option value="1week">1 Week</option>
				<option value="2week">2 Weeks</option>
				<option value="3week">3 Weeks</option>
			</select>
            <!-- errors will go here -->
        </div>
		
		<!-- Required fields to POST -->
		<input type="hidden" name="required" value="title,barcode,checkoutlength">
		<input type="hidden" name="formtype" value="new-item">

       <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>

	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__DIR__) . "/Include/footer.php"); ?>