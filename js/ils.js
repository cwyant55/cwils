$("#more").click(function() {
		var newBloc = $(".InputBlock").eq(0).clone();
		newBloc.find("input").val("");
		deleteBtn = $("<input />")
                    .addClass('delete')
                    .attr("type", "button")
                    .val("X");
    newBloc.append(deleteBtn);
    $(".InputBlock").last().after(newBloc);
})

$("#checkout-item").on("click", ".delete", function() {
		$(this).parent().remove();
})