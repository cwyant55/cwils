<?php 
// Page title
$title = "Search";
include(dirname(__FILE__) . "/Include/header.php");
?>

<!-- extra head tags -->
<?php require(dirname(__FILE__) . "/Include/nav.php"); ?>

<div class="container col-md-8">
	<div class="panel panel-default">
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
	<div class="col-md-6">
		
<?php // search processing
	if (!empty($_GET)) {
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
	}

if ($results) { ?>
	<h2>Search results for <?php echo '<i>' . $searchtype . ' "' . $terms . '"</i>'; ?>:</h2>
	<table class="table table-striped">
	<th>#</th><th>Title</th><th>Barcode</th>
<?php 
$i = 1;
foreach ($results as $result) {
	echo '<tr><td>' . $i . '</td><td><a href="#">' . $result['title'] . '</a></td><td>' . $result['id'] . '</td></tr>';
	$i++;
	
	} ?>
	</table>
<?php }
else {
	echo 'No results.';
}

?>
		</div>
	</div>
	</div>
	
	
</div>
</div><!-- end nav row -->
   
<?php require(dirname(__FILE__) . "/Include/footer.php"); ?>