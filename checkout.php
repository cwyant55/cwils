<?php 
// Page title
$title = "Checkout";
require "Include/header.php";
?>

	<div class="row">
	<div class="container col-md-6">
		<div class="panel panel-default">
		<div class="panel-body">
		<h1>Checkout</h1>
		<form method="post" action="" id="patron-lookup">
		<input type="hidden" name="action" value="get-patron" /><!-- for processing -->
		<div class="form-group">
			<input type="text" class="form-control" name="InputBarcode" placeholder="Enter Patron Barcode" required>
			</div>
		<input type="submit" name="get-patron" value="Submit" />
		</form>
		
		
	<?php //process form action
		if(isset($_POST['action'])) {
			switch($_POST['action']) {
			case 'get-patron' : ?>
			<script>
				$("#patron-lookup").hide();
			</script>
		<?php $barcode = $_POST['InputBarcode'];
		$patron = getPatronbyBarcode($barcode); 
		?>
		<h3>Patron: <?php print($patron['name']); ?></h3>
		
		<!-- checkout single item form -->
		<form method="post" action="" id="checkout-item">
		<input type="hidden" name="action" value="checkout" /><!-- for processing -->
		<div class="row">
		<div class="col-md-6">
			<div class="form-group InputBlock">
			<input type="text" class="form-control" name="InputItemBarcode[]" placeholder="Enter Item Barcode">
			</div>
		</div>
		</div>
		
		<input type="button" id="more" value="Submit" /><!-- submit for each item -->
		<input type="submit" id="submit" value="Done" /><!-- Display receipt and reset form -->
		</form>
		
		<?php break;
			
			case 'checkout' : //submit checkout
				?><p><?php var_dump($patron);?></p>
				
				Patron <?php print($patron['name']); ?> with barcode <?php print($barcode);?> checked out the following items:
				<ul>
				<?php foreach($_POST['InputItemBarcode'] as $value) {
					//get item info, insert into transactions
					?><li><?php print($value); ?></li><?php
				}
			break;
		}
		
		}
		?>
		
		</div>
		</div>
	</div>
	</div>

</div><!-- end nav row -->

   
   
<?php require "Include/footer.php"; ?>