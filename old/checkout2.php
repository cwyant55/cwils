<?php 
// Page title
$title = "Checkout";
require "Include/header.php";
?>

<!-- check for patron barcode in URL -->
<?php if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$patron = getPatronbyBarcode($id);
	if(!$patron) {
		$msg = "Patron <i>" . $id . "</i> not found.";
		}
	}
?>

<!-- patron lookup from form submit -->
<?php if(isset($_POST['action']) && $_POST['action'] == "checkout") {
	$barcode = $_POST['InputBarcode'];
	$patron = getPatronByBarcode($barcode);
	if(!$patron) {
		$msg = "Patron <i>" . $barcode . "</i> not found.";
	}
}
?>

<!-- more head tags -->
<script src="js/magic.js"></script>
<?php include "Include/nav.php"; ?>

	<div class="row">
	<div class="container col-md-6">
		<div class="panel panel-default">
		<div class="panel-body">
		<h1>Checkout</h1>
		
		<!-- print error message if patron not found -->
		<div id="patron-lookup-wrapper">
		<?php if(isset($msg)) { ?>		
		<div class="alert alert-danger"><?php print($msg); ?></div>
		<?php } // if
		
		?><!-- patron lookup form --><?php
		if(!isset($patron)) { ?>	
		
		<form name="patron-lookup" method="post" id="patron-lookup" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<input type="text" class="form-control" name="InputBarcode" placeholder="Enter Patron Barcode" required>
			<input type="hidden" name="action" value="checkout" /><!-- for processing -->
			</div>
       <input type="submit" class="btn btn-success" value="Submit">
		</form><!-- Patron lookup form -->
		</div>
		
	<?php } ?><!-- if -->
		<!-- item checkout form -->
		<?php if(isset($patron)) { ?>
		<div id="checkout-form-wrapper">

			<!-- hide patron lookup form -->
			<script>
			$("#patron-lookup").hide();
			</script>
			<h3>Patron: <?php print($patron['name']); ?></h3>
			
			<!-- form id is used to identify form in magic.js -->
			<form action="processCheckout.php" method="POST" id="checkout" class="process">
			
			<!-- Item Barcode -->
			<div id="itemBarcode-group" class="form-group">
            <label for="itemBarcode">Enter Item Barcode</label>
            <input type="text" class="form-control" name="itemBarcode" placeholder="1000X">
            <!-- errors will go here -->
			<input type="hidden" name="patronBarcode" value="<?php print($patron['barcode']); ?>">
        </div>

       <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>

			
			
			</div><!-- checkout form wrapper -->
		<?php } ?> <!-- if -->
		
		
		</div><!-- panel body -->
	</div>
	</div>
	</div>
</div><!-- end nav row -->

<?php require "Include/footer.php"; ?>