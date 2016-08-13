<?php 
// Page title
$title = "Patron Info";
require(dirname(__FILE__) . "/Include/header.php");
?>

<!-- extra head tags -->
<script src="../js/magic.js"></script>
<?php require(dirname(__FILE__) . "/Include/nav.php"); ?>

<!-- get GET for id and validate -->
<?php

$msg = array("msg" => "", "errors" => "");

	// check for id in URL
	if (!isset($_GET['id'])) {
			$msg['errors'] = "true";
			$msg['msg'] = 'Please enter a barcode.';
	} // if
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		// check if id value is all numbers
		if (!ctype_digit($id)) {
			$msg['errors'] = "true";
			$msg['msg'] = 'Invalid patron barcode format.';
		}
		else {	
		// lookup patron
		$patron = getPatronByBarcode($id);
		if (!isset($patron)) {
			$msg['errors'] = "true";
			$msg['msg'] = "Patron not found.";
		}
		else {	
		$msg['errors'] = "false";
		// get patron checkout info
		$checkouts = getItemsOut($id);
		
		} // else
	} // else
} // if

?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Patron Info</h1>
	
	<?php if ($msg['errors'] == "true") { ?>
		<div class="alert alert-warning"><?php echo $msg['msg']; ?></div>
		<form action="patron-info.php" method="GET">
		<div id="barcode-group" class="form-group">
        <input type="text" class="form-control" name="id" placeholder="0000X" required>
        </div>
		<button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		</form>
	<?php }	?>
	
	<?php if ($msg['errors'] == "false") { ?>
	<!-- display patron info -->
		<p>Name: <?php echo $patron['name']; ?></p>
		<p>Barcode: <?php echo $patron['barcode']; ?></p>
		<p>Check 1: <?php echo $patron['check1']; ?></p>
		<p>Check 1: <?php echo $patron['check2']; ?></p>
		<a href="checkout.php?id=<?php echo $patron['barcode']; ?>" class="btn btn-primary">Checkout</a>
		<br/><br/>
		
		<?php if (isset($checkouts)) { 
			$itemsout = count($checkouts); ?>
			<table class="table table-striped">
			<th>Title</th><th>Item Barcode</th><th>Checked Out</th><th>Due Date</th>
			<?php foreach ($checkouts as $item) {
				echo '<tr><td>' . $item['title'] . '</td><td>' . $item['item'] . '</td><td>' . $item['time'] . '</td><td class="item-status">' . $item['duedate'] . '</td></tr>';
				if (strtotime($item['duedate']) < time()) { ?>
					<script>
			$(".item-status").addClass("alert alert-danger");
						</script>
				<?php }
			}
			?> <tr><td><strong>Total: <?php echo $itemsout; ?></strong></td></tr></table>
			
		<?php }
		else {
			echo "No items checked out.";			
		}
		?>
		
	<?php } ?>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-6">

	

	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__FILE__) . "/Include/footer.php"); ?>