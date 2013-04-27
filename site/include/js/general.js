
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
$("#enterTweet h2 a").attr("role","button");

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
// Initialize widget
function initCharacterCount() {
	var charCountField = "txtEnterTweet";

	// Continue if exists on page
	if(!document.getElementById(charCountField)) { return; }
	
	// Modify default text
	$('#displayCharCountMessage').html("Characters remaining: ");

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

// Browser batch (such as Chrome) for anchor links, such as skip to feature ****************/
$("a[href^='#']").click(function() {
  $("#"+$(this).attr("href").slice(1)+"").focus()
});



