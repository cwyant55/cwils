<?php 
// Page title
$title = "Search";
include(dirname(__FILE__) . "/Include/header.php");
?>
<script src="../js/ils.js"></script>

<!-- extra head tags -->
<?php require(dirname(__FILE__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default" id="search-wrapper">
	<div class="panel-body">
	<h1>Search</h1>
	
	<!-- Search form -->
	<div class="col-md-5">
	<form action="search.php" method="GET" id="search">
	
		<div id="text-group" class="form-group">
            <input type="text" id="text-box" class="form-control" name="text" placeholder="Enter search terms" required>
            <!-- errors will go here -->
        </div>
	</div>
       
	   	 <!-- Search Type -->
		<div class="col-md-3">
        <div id="searchtype-group" class="form-group">
            <select class="form-control" id="searchtype" name="searchtype">
				<option value="keyword">Keyword</option>
				<option value="title">Title</option>
				<option value="barcode">Barcode</option>
				<option value="author">Author</option>
				<option value="format">Format</option>
			</select>
            <!-- errors will go here -->
        </div>
	   </div>
	         <button type="submit" id="search-button" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>	
		
	</div>
	</div>
	<div class="col-md-8">
		
<?php // search box processing
	if (!empty($_GET) && !isset($_GET['barcode'])) {
		$i = 0;
		foreach($_GET as $key => $value) {
			if ($key == "keyword") {
				$query = $value;
			}
			else {
				$query = $key . ":" . $value;
			}
			if ($i > 0){
				$mquery .= ' AND ' . $query;
			}
			else {
				$mquery = $query;
			}
			++$i;
		}
		// run the query
		//$results = solrSearch($query);
		$results = solrSearchFacets($mquery);

if ($results) { 
	$numresults = count($results) - 1;	?>
	<div>Results found: <?php echo $numresults; ?></div>
	<table class="table table-striped">
	<th>#</th><th>Title</th><th>Author</th><th>Barcode</th><th>Format</th>
<?php 
$i = 1;
foreach ($results as $result) {
	if ($i <= $numresults) {
	echo '<tr><td>' . $i . '</td><td><a href="/search.php?barcode=' . $result['barcode'] . '">' . $result['title'] . '</a></td><td>' . $result['author'] . '</td><td>' . $result['barcode'] . '</td><td>' . $result['format'] . '</td></tr>';
	$i++;
	}
	} ?>
	</table>

<!-- facets -->	
<?php

// get facet values
$keys = array();
foreach ($results['facets'] as $key => $value) {
	$keys[] = $key;
}

foreach ($keys as $k) {
	echo 'Narrow by ' . $k . '<br/>';
	foreach ($results['facets'][$k] as $key => $value) {
	if ($value > 1) {
	$params = array_merge($_GET, array($k => $key));
	$url = http_build_query($params);
	echo '<a href="search.php?' . $url . '">' . $key . ' (' . $value . ')</a><br/>';
	}
}
	echo '<br/>';
} // foreach
?>
	
<?php }
else {
	echo '<div class="alert alert-danger">No results.</div>';
}

	} // if

	// item info
	if (isset($_GET['barcode'])) { ?>
		
		<?php $barcode = $_GET['barcode'];
		$res = getItem($barcode);
			if (!$res) { ?>
				<div class="alert alert-danger">
				Item not found!
				</div>
			<?php } //if
		else { ?>
			<h2><?php echo $res['title']; ?></h2>
			<div><strong>Author: </strong><?php echo $res['author']; ?></div>
			<div><strong>Barcode: </strong><?php echo $res['barcode']; ?></div>
			<div><strong>Format: </strong><?php echo $res['format']; ?></div>
			<?php // prettify checkout length
			switch($res['checkoutlength']) {
				case "1week": 
					$checkoutlength = "1 week";
					break;
				case "2week":
					$checkoutlength = "2 weeks";
					break;
				case "3week":
					$checkoutlength = "3 weeks";
					break;
				} // switch ?>
			<div><strong>Checkout Length:</strong> <?php echo $checkoutlength; ?></div>
			<?php // show availability
			if ($res['available'] == "1") {
				echo '<div class="alert alert-success">Available</div>';
			}
			else {
				echo '<div class="alert alert-danger">Not available</div>';				
			}
	 } //else
		
	}
	
?>
		</div>
	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__FILE__) . "/Include/footer.php"); ?>