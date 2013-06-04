
/* Show/hide option buttons ***********************************/
$(".btnOptions a").click(function(e) {
	e.preventDefault();
	var obj = $(this).parent().next();
	var isDisplayed = obj.hasClass('displayOptions');
	if (isDisplayed===false) {
		obj.addClass('displayOptions');
		$(this).attr("aria-expanded",true);
	}
	else {
		obj.removeClass('displayOptions');
		$(this).attr("aria-expanded",false);
	}
});
$(".btnOptions a").attr("role","button");

/* Show/hide write tweet ************************************/
$("#enterTweet h2 a").click(function(e) {
	e.preventDefault();
	var obj = $("#enterTweetContent");
	var isDisplayed = obj.hasClass('displayEnterTweet');
	if (isDisplayed===false) {
		obj.addClass('displayEnterTweet');
		$(this).attr("aria-expanded",true);
		$("#txtEnterTweet").focus();
	}
	else {
		obj.removeClass('displayEnterTweet');
		$(this).attr("aria-expanded",false);
	}
});
$("#enterTweet h2 a").attr("role","button").attr("aria-expanded",false);

/* Character counter ***************************************/
// Update the count
var charCntNum = $('#displayCharCountNumber');
function updateCharCount(charCountField) {
	// Continue if exists on page
	if(!document.getElementById(charCountField)) { return; }
	
	// Calculate number of characters entered
	theField = document.getElementById(charCountField);
	currentCount = 140 - theField.value.length;
	
	// Update number
	charCntNum.html(currentCount);
	
	// Apply style according to character count
	if (currentCount<0) {
		charCntNum.addClass("alert");
	}
	else {
		charCntNum.removeClass("alert");
	}
}
// Initialize char counter widget
function initCharacterCount() {
	var charCountField = "txtEnterTweet";

	// Continue if exists on page
	if(!document.getElementById(charCountField)) { return; }
	
	// Modify default text
	$('#displayCharCountMessage').html($("#enterTweetContent").attr("data-char-remain")+' ');

	// If DM
	/*if ($("#txtDirectMessage").length) { 
		charCountField = "txtDirectMessage";
	}*/

	// Set initial value and variables
	updateCharCount(charCountField);

	// Event listener
	theField.onkeyup = function() {
		updateCharCount(charCountField);
	}
}

/*** show/hide for create list content ***/
//hide create list form
$('#frmCreateList').hide();

//create link to show completed tasks
$('<p id="showCreateList"><a href="#" id="showCreateAnchor" title="show content to create list">Open &#187;<\/a><\/p>').insertBefore('#frmCreateList');

//behavior to show/hide completed tasks
$('#showCreateAnchor').click(function() {
	$('#showCreateList').hide();
	$('#frmCreateList').show();
	
	//create link to hide form
	$('<p id="hideCreateList"><a href="#" id="hideCreateAnchor" title="hide content to create list">&#171; Close<\/a><\/p>').insertAfter('#frmCreateList');
	
	$('#txt_listName').focus();
	
	//behavior to hide completed tasks
	$('#hideCreateAnchor').click(function() {
		$('#hideCreateList').hide();
		$('#frmCreateList').hide();
		$('#showCreateList').show();
		$('#showCreateAnchor').focus();
		return false;
	});
	return false;
});

// Browser batch (such as Chrome) for anchor links, such as skip to feature ****************/
$("a[href^='#']").click(function() {
	$("#"+$(this).attr("href").slice(1)+"").focus()
});

// Validate tweet entry
$('#frmSubmitTweet').submit(function() {
	var x=$("#txtEnterTweet");
	var y = x.val();
	if (y.length>140) {
		alert("You must enter less than 140 characters.");
		x.focus();
		return false;
	}
	if (y.length==0) {
		alert("Please enter a tweet.");
		x.focus();
		return false;
	}
});



