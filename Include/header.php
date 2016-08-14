<?php 
require(dirname(__DIR__) . "/login/loginheader.php");
include(dirname(__DIR__) . "/Include/conn.php");
include(dirname(__DIR__) . "/Include/solr.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php print($title);?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>