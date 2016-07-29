<?php
function db_connect() {
    static $connection;
    if(!isset($connection)) {
        $connection = mysqli_connect('localhost','root','root','ils');
    }
		if($connection === false) {
        return mysqli_connect_error(); 
		}
    return $connection;
}

function db_query($query) {
    $connection = db_connect();
    $result = mysqli_query($connection,$query);
    return $result;
}

function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_select($query) {
    $rows = array();
    $result = db_query($query);
	
		if($result === false) {
        return false;
		}
		
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/* $rows = db_select("SELECT `name`,`email` FROM `users` WHERE id=5");
*if($rows === false) {
*    $error = db_error();
*    // Handle error - inform administrator, log to file, show error page, etc.
} */
?>