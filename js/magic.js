$(document).ready(function() {

    // process forms for patron registration, item checkout
    $('form.process').submit(function(event) {
		
		$('.form-group').removeClass('has-error'); // remove the error class
		$('.help-block').remove(); // remove the error text
		$('.alert-success').remove(); // remove previous successful alerts
		$('.results-found').remove(); // remove results found message for multiple searces
		
		// form action goes to ajax url
		var formAction = $(this).attr("action");

		// form id attribute used to select success/error message
		var formId = $(this).attr("id"); 
		
        // get the form data
		var fd = new FormData();
		var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
        fd.append(input.name,input.value);
    });

		
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : formAction, // the url where we want to POST
            data        : fd, // our data object
			contentType: false,
			processData: false,
            dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data);
				console.log(fd);
				
		// here we will handle errors and validation messages
        if ( ! data.success) {
            
            // handle errors ---------------		
			
			// loop for handling errors
			var i = 0;
			var key = "";
			var errorName = "";
			var keys = Object.keys(data.errors);
			var q = keys.length; 
			
			for (i = "0"; i < q; ++i) {
			key = keys[i];
			errorName = '#' + key + '-group';
			
			 $(errorName).addClass('has-error'); // add the error class to show red input
             $(errorName).append('<div class="help-block">' + data.errors[key] + '</div>');
			}
        } else {

		
		if (formId == "registration")
		{
			var msg = "<p>Patron <i>" + data.name + "</i> registered with barcode <i> " + data.barcode + ".</p>";			
		}
		
		if (formId == "checkout")
		{
			var msg = "<p>Item <i>" + data.item[0].title + "</i> with barcode <i>" + data.barcode + " </i> successfully checked out.</p>";			
		}
		
		if (formId == "patron-lookup")
		{
				var msg = [];
				for (i=0; i < data.patron[0].length; i++) {
				msg.push('Name: ' + data.patron[0][i].name + '<br/>Barcode: ' + '<a href="patron-info.php?id=' + data.patron[0][i].barcode + '">' + data.patron[0][i].barcode + '</a>');
				}
			$('form').append('<h3><span class="results-found">Results found!</span></h3>');
		}
		
            // ALL GOOD! just show the success message!

			for (i=0; i < msg.length; i++) {
            $('form').append('<div class="alert alert-success">' + msg[i] + '</div>');
			}

            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
            // alert('success'); // for now we'll just alert the user
        }
    });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});