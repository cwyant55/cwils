<?php
include(dirname(__FILE__) . "/Include/conn.php");

//unset($errors);
//unset($data);
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array	
	
	 // check for optional required fields	 
	if (isset($_POST['requiredor'])) {
		$keys = $_POST['requiredor'];
		$required = explode(",", $keys);
		$i = 0;
		
		foreach ($required as $value) {
			if (isset($_POST[$value][$i])) {
				$i++;
			 }
	}
	
	if ($i < 1) {
		// fix?
		$errors['name'] = 'At least one field is required.';
	}
} // if
	
	// check for multiple required fields
	if (isset($_POST['required'])) {
		$keys = $_POST['required'];
		$required = explode(",", $keys);
	
	// print error message for empty required fields
		foreach ($required as $value) {
		if (!$_POST[$value]) {
			$errors[$value] = ucfirst($value) . ' is required.';
		}
	}	
	} // if
	
	// proceed if no errors
	if (!$errors) {
	
	// checkout form, make sure item exists and is available
	if ($_POST['formtype'] == "checkout") {
		$barcode = $data['barcode'] = $_POST['barcode'];
		$patronBarcode = $data['patronBarcode'] = $_POST['patronBarcode'];	
		$res = getItem($barcode);
			if (!$res) {
			$errors['barcode'] = "Item not found.";
			}
			if ($res['available'] == "0") {
			$errors['barcode'] = "Item is checked out.";
			}
		else {
			$title = $res['title'];
				if ($res['checkoutlength'] == "3week") {
				$duedate = date('Y-m-d G:i:s', strtotime('+3 Week'));
				}
				elseif ($res['checkoutlength'] == "2week") {
				$duedate = date('Y-m-d G:i:s', strtotime('+2 Week'));
				}
				else {
				$duedate = date('Y-m-d G:i:s', strtotime('+1 Week'));
				}
		}
	}
	
	// checkin form, make sure item exists and was checked out
	if ($_POST['formtype'] == "checkin") {
		$barcode = $data['barcode'] = $_POST['barcode'];
		$res = getItem($barcode);
			if (!$res) {
			$errors['barcode'] = "Item not found.";
			}
			elseif ($res['available'] == "1") {
			$errors['barcode'] = "Item was not checked out.";
			}
			else { // no errors }
	}
	}
	
	// new item form, make sure barcode does not exist
	if ($_POST['formtype'] == "new-item") {
		$barcode = $data['barcode'] = $_POST['barcode'];
		$res = getItem($barcode);
			if ($res) {
			$errors['barcode'] = "Item barcode already in use.";
			}
	}
} // if
	
// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if (!empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors'] = $errors;
		
    } else {

        // if there are no errors process our form, then return a message

        // DO ALL YOUR FORM PROCESSING HERE
		
		// assign variables
		if ($_POST['formtype'] == "registration") {
		$name = $data['name'] = $_POST['name'];
		$barcode = $data['barcode'] = $_POST['barcode'];
        $query = "INSERT INTO patrons (name, barcode) VALUES ('$name', '$barcode')";
		db_query($query);
		
		// show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		} // registration
		
		if ($_POST['formtype'] == "checkout") {
		// create transaction record
        $query = "INSERT INTO transactions (patron, item, title, duedate) VALUES ('$patronBarcode', '$barcode', '$title', '$duedate')";
		db_query($query);
		
		// error handling
		
		// set item availability as checked out
		$query = "UPDATE items SET available='0' WHERE barcode='$barcode'";
		db_query($query);
		
		// error handling
		
		// include item data in data array
		$data['item'] = array($res);
		
		// show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		
		} // checkout
		
		if ($_POST['formtype'] == "checkin") {
		// update transaction record with checkin timestamp and anonymize patron barcode
        $query = "UPDATE transactions SET patron = '-1', checkedin = now() WHERE item='$barcode'";
		db_query($query);
		
		// error handling
		
		// set item availability as checked in
		$query = "UPDATE items SET available='1' WHERE barcode='$barcode'";
		db_query($query);
		
		// error handling
		
		// include item data in data array
		$data['item'] = array($res);
		
		// show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		
		} // checkin
		
		if ($_POST['formtype'] == "new-item") {
		// assign variables (should be able to automate this)
		$title = $data['title'] = $_POST['title'];
		$checkoutlength = $data['checkoutlength'] = $_POST['checkoutlength'];
		
		// insert item data
		$query = "INSERT INTO items (barcode, title, checkoutlength, available) VALUES ('$barcode', '$title', '$checkoutlength', '1')";
		db_query($query);
		
		// error handling
		
		// include item data in data array
		$data['item'] = array($res);
		
		// show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
		
		} // checkout
		
		if ($_POST['formtype'] == "patron-lookup") {
		if (isset($_POST['name']) && isset($_POST['barcode'])) { // name and barcode
			$name = $data['name'] = $_POST['name'];
			$barcode = $data['barcode'] = $_POST['barcode'];
			$query = "SELECT * FROM `patrons` WHERE `name` LIKE '$name%' AND `barcode` LIKE '$barcode%'";
			}
			elseif (isset($_POST['name'])) { // name only
			$name = $data['name'] = $_POST['name'];
			$query = "SELECT * FROM `patrons` WHERE `name` LIKE '$name%'";
			}
			elseif (isset($_POST['barcode'])) { // barcode only
			$barcode = $data['barcode'] = $_POST['barcode'];
			$query = "SELECT * FROM `patrons` WHERE `barcode` LIKE '$barcode%'";
			}
		
		$res = db_select($query);
			if (!$res) {
				$errors['name'] = "No results.";
				$data['success'] = false;
				$data['errors']  = $errors;
			}
			else {
			$data['patron'] = array($res);
			$data['success'] = true;
			$data['message'] = 'Success!';
			}
		
		} // patron lookup
		
    }

    // return all our data to an AJAX call
echo json_encode($data);
?>