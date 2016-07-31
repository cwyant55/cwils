<?php
include "Include/conn.php";

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array
	
    if (empty($_POST['patronBarcode']))
        $errors['patronBarcode'] = 'Patron barcode is required.';
		
    if (empty($_POST['itemBarcode']))
        $errors['itemBarcode'] = 'Item barcode is required.';

		$b = $data['itemBarcode'] = $_POST['itemBarcode'];
		$p = $data['patronBarcode'] = $_POST['patronBarcode'];	
		$res = getItem($b);
			if (!$res) {
			$errors['itemBarcode'] = "Item not found.";
			}
			if ($res['available'] == "0") {
			$errors['itemBarcode'] = "Item is checked out.";
			}
	
// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {	

        // if there are no errors process our form, then return a message

        // DO ALL YOUR FORM PROCESSING HERE		
		
		// create transaction record
        $query = "INSERT INTO transactions (patron, item) VALUES ('$p', '$b')";
		db_query($query);
		
		// error handling
		
		// set item availability as checked out
		$query = "UPDATE items SET available='0' WHERE barcode='$b'";
		db_query($query);
		
		// error handling

        // show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		
		// include lookup data in data array
		$data['item'] = array($res);
	}
    // return all our data to an AJAX call
    echo json_encode($data); ?>