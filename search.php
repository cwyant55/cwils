<?php 
// Page title
$title = "Search";
include(dirname(__FILE__) . "/Include/header.php");
?>

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
            <input type="text" class="form-control" name="text" placeholder="Enter search terms" required>
            <!-- errors will go here -->
        </div>
	</div>
       
	   	 <!-- Search Type -->
		<div class="col-md-3">
        <div id="searchtype-group" class="form-group">
            <select class="form-control" name="searchtype">
				<option value="keyword">Keyword</option>
				<option value="title">Title</option>
				<option value="barcode">Barcode</option>
			</select>
            <!-- errors will go here -->
        </div>
	   </div>
		<!-- Required fields to POST -->
		<!-- <input type="hidden" name="required" value="text"> -->
		<!-- <input type="hidden" name="formtype" value="search"> -->

       <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>
		
		</form>
	</div>
	</div>
	<div class="col-md-8">
		
<?php // search box processing
	if (!empty($_GET) && !isset($_GET['barcode'])) {
		$terms = $_GET['text'];
		$searchtype = $_GET['searchtype'];
			switch ($searchtype) {
				case "keyword":
					$query = $terms;
					break;
				case "title":
					$query = 'title:' . $terms;
					break;
				case "barcode":
					$query = 'barcode:' . $terms;
					break;
				} // switch
				
		// run the query
		$results = solrSearch($query);

if ($results) { ?>
	<h2>Search results for <?php echo '<i>' . $searchtype . ' "' . $terms . '"</i>'; ?>:</h2>
	<table class="table table-striped">
	<th>#</th><th>Title</th><th>Barcode</th>
<?php 
$i = 1;
foreach ($results as $result) {
	echo '<tr><td>' . $i . '</td><td><a href="/search.php?barcode=' . $result['barcode'] . '">' . $result['title'] . '</a></td><td>' . $result['barcode'] . '</td></tr>';
	$i++;
	
	} ?>
	</table>
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
			<div><strong>Barcode:</strong> <?php echo $res['barcode']; ?></div>
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