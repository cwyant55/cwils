$(document).ready(function() {
	
// Change search box name to match select list value, and prevent
// select list value from appearing in $_GET
$("#search-button").click(function() {
		var test = $("#searchtype option:selected").val();
		$("#text-box").attr("name", test);
		$("#searchtype").attr("disabled", "true");
})

})