<?php require "../Include/conn.php";
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

}

?>