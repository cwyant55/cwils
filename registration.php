<?php 
// Page title
$title = "Patron Registration";
require "Include/header.php";
?>

<div class="container col-md-8">
	<div class="panel panel-default">
	<div class="panel-body">
	<h1>Patron Registration</h1>
	</div>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
		<form action="" method="post">
			<input type="hidden" name="action" value="register" /><!-- for processing -->
			<div class="form-group">
				<input type="text" class="form-control" name="InputName" placeholder="Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="InputBarcode" placeholder="Barcode" required>
			</div>
			<div class="checkbox">
			<label>
			<input type="checkbox" name="check1" value="1">Check me out
			</label>
			</div>
			<div class="checkbox">
			<label>
			<input type="checkbox" name="check2" value="1">Check me out again!
			</label>
			</div>
		<input type="submit" id="submit" class="btn btn-default"></button>
		</form>
		
		<!-- Process patron registration form -->
		<?php		
		if(isset($_POST['action'])) {
			switch($_POST['action']) {
			case 'register' :
			
			$name = $_POST['InputName'];
			$barcode = $_POST['InputBarcode'];
			
			if(isset($_POST['check1'])) {$check1 = "1"; }
				else {$check1 = "0"; }
			if(isset($_POST['check2'])) {$check1 = "1"; }
				else {$check2 = "0"; }

			$query = "INSERT INTO patrons (name, barcode, check1, check2) VALUES ('$name', '$barcode', '$check1', '$check2')";
				db_query($query); ?>
			
			<h2>Success!</h2>
			<p>Patron: <?php print($name);?></p>
			<p>Barcode: <?php print($barcode);?></p>
			<?php if($check1 == '1' ) { print("<p>Check1 was checked.</p>"); } ?>
			<?php if($check2 == '1' ) { print("<p>Check2 was checked.</p>"); }
			
			break;
		}
		}
		?>

	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require "Include/footer.php"; ?>