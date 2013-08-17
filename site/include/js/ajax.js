
// Ajax for creating/destroying a favorite
$('a[href*="favorite_"]').click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txtMakeFav      = $("#main").attr("data-fav-make"); //"make favorite";
	var txtRemoveFav    = $("#main").attr("data-fav-remove"); //"remove favorite";
	var txtAlertAdded   = $("#main").attr("data-fav-alert-added"); //"The favorite has been added.";
	var txtAlertRemoved = $("#main").attr("data-fav-alert-removed"); //"The favorite has been removed.";	

	if (url_replace.indexOf("create") != -1) {
		$.ajax({
			url: url_send,
			success: function(response) {
				alert(txtAlertAdded);
				
				$(a).addClass("favorited");

				url_replace = url_replace.replace(/create/,"destroy");
				$(a).attr("href", url_replace);

				$(a).attr("title", txtRemoveFav);
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
				alert(txtAlertRemoved);
				
				$(a).removeClass("favorited");

				url_replace = url_replace.replace(/destroy/,"create");
				$(a).attr("href", url_replace);

				$(a).attr("title", txtMakeFav);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	
	//$(this).focus();

});


