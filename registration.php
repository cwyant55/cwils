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
		<form id="register_patron">
		<input type="hidden" name="action" value="register" /><!-- for js -->
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
		
		<div class="alert alert-success" role="alert" style="display: none;" id="notification">Success!</div>
	</div>

	</div>
	
	
</div>
</div><!-- end nav row -->

<script><!-- process form without redirect -->
$('#register_patron').submit(function() {
  var post_data = $('#register_patron').serialize();
  $.post('forms/registerPatron.php', post_data, function(data) {
    $('#notification').show();
  });
});
</script>   
   
<?php require "Include/footer.php"; ?>