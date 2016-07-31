$(document).ready(function() {

    // process forms for patron registration, item checkout
    $('form.process').submit(function(event) {
		
		$('.form-group').removeClass('has-error'); // remove the error class
		$('.help-block').remove(); // remove the error text
		
		// form action goes to ajax url
		var formAction = $(this).attr("action"); 
		
		// form id for success message
		if ($(this).attr("id") == "registration") {
			var msg = "registration";
		} 
		
		// form id for success message
		if ($(this).attr("id") == "checkout") {
			var msg = "checkout";
		} 
		
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
			if (data.errors.name) {
                $('#name-group').addClass('has-error'); // add the error class to show red input
                $('#name-group').append('<div class="help-block">' + data.errors.name + '</div>'); // add the actual error message under our input
            }

            // handle errors for barcode ---------------
            if (data.errors.barcode) {
                $('#barcode-group').addClass('has-error'); // add the error class to show red input
                $('#barcode-group').append('<div class="help-block">' + data.errors.barcode + '</div>'); // add the actual error message under our input
            }
			
			 // handle errors for itemBarcode ---------------
            if (data.errors.itemBarcode) {
                $('#itemBarcode-group').addClass('has-error'); // add the error class to show red input
                $('#itemBarcode-group').append('<div class="help-block">' + data.errors.itemBarcode + '</div>'); // add the actual error message under our input
            }

        } else {

		
		if (msg == "registration")
		{
			msg = "<p>Patron <i>" + data.name + "</i> registered with barcode <i> " + data.barcode + ".</p>";			
		}
		
		if (msg == "checkout")
		{
			msg = "<p>Item <i>" + data.item[0].title + "</i> with barcode <i>" + data.itemBarcode + " </i> successfully checked out.</p>";			
		}
		
            // ALL GOOD! just show the success message!			
            $('form').append('<div class="alert alert-success">' + msg + '</div>');

            // usually after form submission, you'll want to redirect
            // window.location = '/thank-you'; // redirect a user to another page
            // alert('success'); // for now we'll just alert the user
        }
    });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});