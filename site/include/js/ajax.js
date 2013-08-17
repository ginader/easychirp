
// Ajax for creating/destroying a favorite
$('a[href*="favorite_"]').click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");

	if (url_replace.indexOf("create") != -1) {
		$.ajax({
			url: url_send,
			success: function(response) {
				alert("The favorite has been added.");
				
				$(a).addClass("favorited");

				url_replace = url_replace.replace(/create/,"destroy");
				$(a).attr("href", url_replace);

				$(a).attr("title", "remove favorite");
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	else {
		$.ajax({
			url: url_send,
			success: function(response) {
				alert("The favorite has been removed.");
				
				$(a).removeClass("favorited");

				url_replace = url_replace.replace(/destroy/,"create");
				$(a).attr("href", url_replace);

				$(a).attr("title", "make favorite");
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	
	//$(this).focus();

});


