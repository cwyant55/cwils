<?php 
// Page title
$title = "Home";
require "Include/header.php";
 ?>
 
<?php // get # patrons
$res = db_query("SELECT * FROM `patrons`");
	if($res === false) {
	$error = db_error();
}
$patrons = mysqli_num_rows($res);
?>

<?php // get # patrons registered today
$res = db_query("SELECT * FROM `patrons` WHERE DATE(`timestamp`) = CURDATE()");
	if($res === false) {
	$error = db_error();
}
$today = mysqli_num_rows($res);
?>

<?php // get # patrons registered yesterday
$res = db_query("SELECT * FROM `patrons` WHERE DATE(`timestamp`) = CURDATE() - 1");
	if($res === false) {
	$error = db_error();
}
$yesterday = mysqli_num_rows($res);
?>


<div class="container col-md-8">
	<div class="jumbotron panel panel-default">
	<h1>Hey! How's it going?</h1>
	<p>Welcome to your new ILS.</p>
	</div>
	
	<div class="row">
	<div class="container col-md-6">
	
<!-- Dashboard chart thingy -->
<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Yesterday", "Today"],
        datasets: [{
            label: 'New Patron Registrations',
            data: [<?php print($yesterday); ?>, <?php print($today); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
</script>
	</div>
	
	</div>
</div>

</div><!-- end nav row -->

   
   
<?php require "Include/footer.php"; ?>