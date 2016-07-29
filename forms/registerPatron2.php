<?php 
// Page title
$title = "Page Title";
require "../Include/header.php";
?>

<div class="container col-md-8">
<?php
// Process patron registration form

if(isset($_POST['action'])) {

	switch($_POST['action']) {
	case 'register' :

$name = $_POST['InputName'];
$barcode = $_POST['InputBarcode'];

if ($_POST['check1'] == '1') {
	$check1 = '1';
}

if ($_POST['check2'] == '1') {
	$check2 = '1';
}

$query = "INSERT INTO patrons (name, barcode, check1, check2) VALUES ('$name', '$barcode', '$check1', '$check2')";
db_query($query);

break;
}

?><h2>Success!</h2>
<p>Patron: <?php print($name);?></p>
<p>Barcode: <?php print($barcode);?></p>

<?php
}
?>

</div>
 
</div><!-- end nav row -->

<?php require "../Include/footer.php"; ?>