
// Creating/destroying a favorite
$('a[href*="favorite_"]').attr("role","button").click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.MakeFav      = $("#main").attr("data-fav-make"); //"make favorite";
	txt.RemoveFav    = $("#main").attr("data-fav-remove"); //"remove favorite";
	txt.AlertAdded   = $("#main").attr("data-fav-alert-added"); //"The favorite has been added.";
	txt.AlertRemoved = $("#main").attr("data-fav-alert-removed"); //"The favorite has been removed.";

	if (url_replace.indexOf("create") != -1) {
		$.ajax({
			url: url_send,
			success: function(response) {
				openModal(e, txt.AlertAdded, a);

				$(a).addClass("favorited");

				url_replace = url_replace.replace(/create/,"destroy");
				$(a).attr("href", url_replace);

				$(a).attr("title", txt.RemoveFav);
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
				openModal(e, txt.AlertRemoved, a);

				$(a).removeClass("favorited");

				url_replace = url_replace.replace(/destroy/,"create");
				$(a).attr("href", url_replace);

				$(a).attr("title", txt.MakeFav);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
});

// Creating/destroying a blocked user
$('a[href*="block_"]').attr("role","button").click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.block        = $("#main").attr("data-block"); //"Block User";
	txt.unblock      = $("#main").attr("data-unblock"); //"Unblock User";
	txt.AlertBlock   = $("#main").attr("data-msg-block"); //"The user has been blocked.";
	txt.AlertUnblock = $("#main").attr("data-msg-unblock"); //"The user has been unblocked.";

	if (url_replace.indexOf("create") != -1) {

		if (!confirm("Are you sure you want to block this user?")) { //(txtAlertSureDelete)) {
			 return false;
		}

		// Create blocking
		$.ajax({
			url: url_send,
			success: function(response) {
				$(a).html(txt.unblock);
				$(a).siblings(".span-user-blocked").css("display", "inline");

				url_replace = url_replace.replace(/create/,"destroy");
				$(a).attr("href", url_replace);

				openModal(e, txt.AlertBlock, a);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	else {
		// Remove blocking
		$.ajax({
			url: url_send,
			success: function(response) {
				$(a).html(txt.block);
				$(a).siblings(".span-user-blocked").css("display", "none");

				url_replace = url_replace.replace(/destroy/,"create");
				$(a).attr("href", url_replace);

				openModal(e, txt.AlertUnblock, a);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
});

// Muting/unmuting a user
$('a[href*="mute_"]').attr("role","button").click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.mute        = $("#main").attr("data-mute");
	txt.unmute      = $("#main").attr("data-unmute");
	txt.AlertMute   = $("#main").attr("data-msg-mute");
	txt.AlertUnmute = $("#main").attr("data-msg-unmute");

	if (url_replace.indexOf("create") != -1) {
		// Create muting
		$.ajax({
			url: url_send,
			success: function(response) {
				$(a).html(txt.unmute);
				$(a).siblings(".span-user-muted").css("display", "inline");

				url_replace = url_replace.replace(/create/,"destroy");
				$(a).attr("href", url_replace);
				
				openModal(e, txt.AlertMute, a);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	else {
		// Remove muting
		$.ajax({
			url: url_send,
			success: function(response) {
				$(a).html(txt.mute);
				$(a).siblings(".span-user-muted").css("display", "none");

				url_replace = url_replace.replace(/destroy/,"create");
				$(a).attr("href", url_replace);

				openModal(e, txt.AlertUnmute, a);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
});

// Deleting a DM
$('a[href*="direct_delete"]').attr("role","button").click(function(e) {

	if (!confirm(txtAlertSureDelete)) {
		 return false;
	}

	e.preventDefault();

	var a = $(this);
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.AlertDeleted = $("#main").attr("data-msg-dm-deleted");

	$.ajax({
		url: url_send,
		success: function(response) {

			$(a).parent().parent().hide('slow', function() {
				this.remove();
				alert(txt.AlertDeleted);
			});

		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	})
});

// Deleting a list member
$('a[href*="list_member_delete"]').attr("role","button").click(function(e) {

	if (!confirm(txtAlertSureDelete)) {
		 return false;
	}

	e.preventDefault();

	var a = $(this);
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.AlertDeleted = $("h1").attr("data-msg-list-member-deleted");

	$.ajax({
		url: url_send,
		success: function(response) {

			$(a).parent().parent().hide('slow', function() {
				this.remove();
				alert(txt.AlertDeleted);
			});

		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	})
});

// Adding a member to a list
$('.frmListAddMember').submit(function(e) {

	e.preventDefault();

	var url_send = "/list_add_member/true";
	var data = $(this).serialize();
	var AlertAdded = $("#myLists").attr("data-msg-list-added");
	var btn = $(this).find('button');

	$.ajax({
		type: "POST",
		url: url_send,
		data: data,
		success: function(response) {
			var ea = $(e.target).parent().parent().find(".memCnt a");
			var ct = ea.html();
			var ddMemCnt = parseInt(ct, 10) + 1;
			$(ea).parent().parent().find(".memCnt a").html(ddMemCnt);
		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	});

	openModal(e, AlertAdded, btn);
});

// Uploading image
$('#frmTweetImage').submit(function(e, files) {

	e.preventDefault();

	var url_send = $(this).attr("action");
	var image_path = $("#imagePath").val();
	var image_title = $("#imageTitle").val();
	var txt = {};
	txt.alertImgType  = "Invalid file type. Only GIF, JPG, and PNG formats are allowed.";
	txt.alertImgSize  = "The file size too large. The limit is 5 MB.";
	txt.alertImgTitle = "Please provide a title for this image.";
	txt.alertImgDesc  = "Please provide a longer description for this image or leave blank if not needed.";
	txt.alertImgSuccess = "Success! The URL has been added to the input field.\nThe image link is: ";

	//validate image type
	var v = new RegExp();
	v.compile("(.gif|.GIF|.jpeg|.JPEG|.jpg|.JPG|.png|.PNG)$");
	if (!v.test(image_path)) {
		openModal(e, txt.alertImgType, $("#imagePath"));
		return false;
	}

	//validate image size
	var image_size = ($("#imagePath")[0].files[0].size);// / 1024);
	if (image_size > 5242880) { //2097152 2 Megs
		openModal(e, txt.alertImgSize, $("#imagePath"));
		return false;
	}

	//check length of title
	if (image_title.length == "") {
		openModal(e, txt.alertImgTitle, $("#imageTitle"));
		return false;
	}

	//check length of description
	var image_desc = $("#imageDesc").val();
	if (image_desc.length > 0 && image_desc.length < 15) {
		openModal(e, txt.alertImgDesc, $("#imageDesc"));
		return false;
	}

	onsuccess = function(data, textStatus, jqXHR){
		// Enable submit button
		$("#btnSubmitImage").removeAttr("disabled");
		// Remove processing message
		$("#imgUploadMessage").remove();

		var txtInput = $('#txtEnterTweet');
		var imgLink = "http://easychirp.com/img/" + data;

		// Delete existing on page
		$('#imgLinkContainer').remove();

		// Output on page
		$('<p id="imgLinkContainer">The image link is: <a target="_blank" href="' + imgLink + '">' + imgLink + '</a></p>').insertAfter('#frmTweetImage fieldset div:last-child');

		// Update counter
		if ( document.getElementById("txtEnterTweet") ) {
			updateCharCount("txtEnterTweet");
		}

		// Insert in tweet input; send success modal with focus
		txtInput.val(txtInput.val() + " " + imgLink);
		openModal(e, txt.alertImgSuccess + imgLink, txtInput);
	}

	var options = {
		url: url_send,
		beforeSerialize: function (form, options) {
			options.data = {
				ajax: true
			};
		},
		beforeSubmit: function() {
		    // Disable submit button
		    $("#btnSubmitImage").attr("disabled", "disabled");
		    // Add processing message
		    $('<span role="alert" id="imgUploadMessage">Processing...</span>').insertAfter('#btnSubmitImage');
		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		},
		success: onsuccess
	};

	$(this).ajaxSubmit(options);
	return false;

});

// Creating a retweet // will do destroying later
$('a[href*="retweet_"]').attr("role","button").click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.MakeRt       = $("#main").attr("data-rt-make");
	txt.RemoveRt     = $("#main").attr("data-rt-remove");
	txt.AlertAdded   = $("#main").attr("data-rt-alert-added");
	txt.AlertRemoved = $("#main").attr("data-rt-alert-removed");

	if (url_replace.indexOf("create") != -1) {
		$.ajax({
			url: url_send,
			success: function(response) {
				$(a).addClass("retweeted");

				//url_replace = url_replace.replace(/create/,"destroy");
				//$(a).attr("href", url_replace);
				$(a).removeAttr("href").attr("tabindex","-1");

				//$(a).attr("title", txt.RemoveRt);
				$(a).attr("title", "retweeted");

				openModal(e, txt.AlertAdded, a);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	// else {
	// 	$.ajax({
	// 		url: url_send,
	// 		success: function(response) {
	// 			alert(txt.AlertRemoved);

	// 			$(a).removeClass("favorited");

	// 			url_replace = url_replace.replace(/destroy/,"create");
	// 			$(a).attr("href", url_replace);

	// 			$(a).attr("title", txt.MakeFav);
	// 		},
	// 		error: function(xhr) {
	// 			alert('Error. Status = ' + xhr.status);
	// 		}
	// 	})
	// }
});

// Following/unfollowing a user
$('a[href*="follow_user"]').attr("role","button").click(function(e) {
	e.preventDefault();

	var a = $(this);
	var url_replace = this.href;
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.follow          = $("#userDetails").attr("data-follow");
	txt.unfollow        = $("#userDetails").attr("data-unfollow");
	txt.following       = $("#userDetails").attr("data-following");
	txt.notfollowing    = $("#userDetails").attr("data-not-following");
	txt.AlertFollowed   = $("#userDetails").attr("data-msg-followed");
	txt.AlertUnfollowed = $("#userDetails").attr("data-msg-unfollowed");

	if (url_replace.indexOf("unfollow") == -1) {
		// Follow
		$.ajax({
			url: url_send,
			success: function(response) {
				alert(txt.AlertFollowed);

				$(a).html(txt.unfollow);
				$("#spanFollowCurrent").html(txt.following);

				url_replace = url_replace.replace(/follow_user/,"unfollow_user");
				$(a).attr("href", url_replace);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
	else {
		// Unfollow
		$.ajax({
			url: url_send,
			success: function(response) {
				alert(txt.AlertUnfollowed);

				$(a).html(txt.follow);
				$("#spanFollowCurrent").html(txt.notfollowing);

				url_replace = url_replace.replace(/unfollow_user/,"follow_user");
				$(a).attr("href", url_replace);
			},
			error: function(xhr) {
				alert('Error. Status = ' + xhr.status);
			}
		})
	}
});

// Deleting a tweet
$('a[href*="tweet_delete"]').click(function(e) {

	if (!confirm(txtAlertSureDelete)) {
		 return false;
	}

	e.preventDefault();

	var a = $(this);
	var url_send = this.href.replace("false","true");
	var txt = {};
	txt.AlertDeleted = $("#main").attr("data-msg-tweet-deleted");

	$.ajax({
		url: url_send,
		success: function(response) {

			$(a).closest("div.tweet").hide('slow', function() {
				this.remove();
				alert(txt.AlertDeleted);
			});

		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	})
});

// Tweet threads/conversation via reply
function theRespGuts(e) {
	e.preventDefault();

	// Set variables in obj
	data = {};
	data.respParent = $(this).parent().parent();
	data.url = this.href;
	data.url = data.url.replace("status","getResponse");

	// Deactivate link clicked
	$("a[rel='response']").unbind('click', theRespGuts);
	$(this).attr("href","javascript:;");
	$(this).removeAttr("rel");
	$(this).removeAttr("title");

	$.ajax({
		url: data.url,
		success: function(response) {
			data.respParent.after(response);
			$("a[rel='response']").bind('click', theRespGuts).attr("role","button");
			$(data.respParent).next('[tabindex=-1]').focus();
			
			// the following is duplicated in general.js
			$(data.respParent).next().find(".btnSecondary").attr("aria-expanded", "false")
			.click(function(e) {
				e.preventDefault();

				// set vars
			    var objDesc = $(this).next(".imageDesc");
			    var isDisplayed = $(objDesc).is(":visible");

				if (isDisplayed===false) {
					$(objDesc).css("display","block");
					$(this).attr("aria-expanded",true);
				}
				else {
					$(objDesc).css("display","none");
					$(this).attr("aria-expanded",false);
				}
				});
		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	});
	$(this).focus();
}
$('a[rel="response"]').bind('click', theRespGuts).attr("role","button");

// Adding a saved search
$('a[href*="search_save"]').click(function(e) {

	e.preventDefault();

	data = {};
	data.anchorParent = $(this).parent();
	data.url_send = this.href.replace("false","true");
	data.AlertAdded = $("#srch-msgs").attr("data-msg-search-saved");

	$.ajax({
		url: data.url_send,
		success: function(response) {

			$(data.anchorParent).html(data.AlertAdded);
			$(data.anchorParent).attr('tabindex','-1');
			$(data.anchorParent).attr('aria-role','alert');
			$(data.anchorParent).focus();

		},
		error: function(xhr) {
			alert('Error. Status = ' + xhr.status);
		}
	})
});

// Shortening a URL

// Clear shortened URL
var txtClear = $("#frmUrlShort").attr("data-clear");
$('<button type="reset" id="urlClear">'+txtClear+'</button>').insertAfter('#btnShorten');
$('#urlClear').click(function() {
	$('#urlLong').val("");
	$('#urlLong').focus();
	$('#urlShortResult').remove();
	$('#urlLongResult').remove();
	return false;
});

// Get shortened URL
$("#frmUrlShort").submit(function(ev) {

	ev.preventDefault();

	var frmAction  = $(this).attr('action');
	var objLongURL = $('#urlLong');
	var txtLongURL = $('#urlLong').val();
	var txtUrlService = $('input[name=urlService]').val(); //$('input:radio[name=urlService]:checked').val();

	//validate for completed input
	if (txtLongURL == "") {
		alert("URL input is blank. Please enter a URL.");
		objLongURL.focus();
		return false;
	}
	//validate for non bit.ly
	var pos = txtLongURL.indexOf("http://bit.ly");
	if (pos != -1) {
		alert("URL cannot be a bit.ly link. Please enter a different URL.");
		objLongURL.focus();
		return false;
	}
	//validate for valid URL
	var urlReg = /^HTTP|HTTP|http(s)?:\/\/(www\.)?[A-Za-z0-9]+([\-\.]{1}[A-Za-z0-9]+)*\.[A-Za-z]{2,40}(:[0-9]{1,40})?(\/.*)?$/;
	if ( (!urlReg.test(txtLongURL)) || (txtLongURL.length <=7) ) {
		alert("You must provide a valid URL.");
		objLongURL.focus();
		return false;
	}

	render = function(short,long) {
		//add short URL to Tweet input
		txtInput = $('#txtEnterTweet');
		if ( document.getElementById("txtDirectMessage") ) {
			txtInput = $('#txtDirectMessage');
		}
		txtInput.val(txtInput.val() + " " + short);

		//update counter
		if ( document.getElementById("txtEnterTweet") ) {
			updateCharCount("txtEnterTweet");
		}
		else {
			updateCharCount("txtDirectMessage");
		}

		//delete existing on page
		$('#urlShortResult').remove();
		$('#urlLongResult').remove();

		//output on page
		$('<p id=\'urlShortResult\'>Shortened URL: <a target=\'_blank\' href="' + short + '">' + short + '</a></p>').insertAfter('#frmUrlShort button[type=reset]');
		$('<p id=\'urlLongResult\'>Original URL: <a target=\'_blank\' href="' + long + '">' + long + '</a></p>').insertAfter('#urlShortResult');
		alert("Success! The shortened URL has been added to the input field.");

		//focus tweet/dm input
		if ( document.getElementById("txtEnterTweet") ) {
			$("#txtEnterTweet").focus();
		}
		else {
			$("#txtDirectMessage").focus();
		}
	}

	$.ajax({
		url: frmAction,
		type: "POST",
		dataType: 'json',
		data: {
			ajax: "true",
			url_long: txtLongURL,
			urlService: txtUrlService
		},
		success: function(data) {
			render(data.short_url, txtLongURL); // short URL, long URL
		},
		error: function(data) {
			alert("error");
		}
	});
});
