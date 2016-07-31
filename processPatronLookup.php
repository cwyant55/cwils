<?php
include "Include/conn.php";

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array	

    if (empty($_POST['barcode']))
        $errors['barcode'] = 'Barcode is required.';
	
// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

        // if there are no errors process our form, then return a message

        // DO ALL YOUR FORM PROCESSING HERE
		$barcode = $_POST['barcode'];
        $res = getPatronByBarcode($barcode);

		// include lookup data in data array
		$data['patron'] = array($res);
		
        // show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		
    }

    // return all our data to an AJAX call
    echo json_encode($data);