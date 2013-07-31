
/* Show/hide option buttons ***********************************/
$(".btnOptions > h3 > a").click(function(e) {
	e.preventDefault();

    // set vars
    var obj = $(this).parent().next();
	var isDisplayed = obj.hasClass('displayOptions');

	// first close both sections
    $(".btnOptions ul").removeClass('displayOptions');
	$(".btnOptions h3 a").attr("aria-expanded",false);

	// open section clicked
	if (isDisplayed===false) {
		obj.addClass('displayOptions');
		$(this).attr("aria-expanded",true);
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
	
	// Modify default text
	$('#displayCharCountMessage').html($("#enterTweetContent").attr("data-char-remain")+' ');

	// If DM
	if ($("#txtDirectMessage").length) { 
		charCountField = "txtDirectMessage";
		$('#displayCharCountMessage').html($("#frmDirectMessage").attr("data-char-remain")+' ');
	}

	// Continue if exists on page
	if(!document.getElementById(charCountField)) { return; }

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

// Get open & close text values
var txtOpen = $("#createList").attr("data-open");
var txtClose = $("#createList").attr("data-close");

// Create link to show content
$('<p id="showCreateList"><a href="#" id="showCreateAnchor">' + txtOpen + ' &#187;<\/a><\/p>').insertBefore('#frmCreateList');

// Behavior to show/hide content
$('#showCreateAnchor').click(function() {
	$('#showCreateList').hide();
	$('#frmCreateList').show();
	
	// Create link to close content
	$('<p id="hideCreateList"><a href="#" id="hideCreateAnchor">&#171; ' + txtClose + '<\/a><\/p>').insertAfter('#frmCreateList');
	$('#txt_listName').focus();
	
	// Behavior to hide content
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

// Validate URL shortener
$("#frmUrlShort").submit(function(ev) {
	//ev.preventDefault();		
	var objLongURL = $('#urlLong');
	var txtLongURL = $('#urlLong').val();
	//var txtUrlService = $('input:radio[name=urlService]:checked').val();
	
	//validate for completed field
	if (txtLongURL == "") {
		alert("URL field is blank. Please enter a URL.");
		objLongURL.focus();
		return false;
	}
	//validate for non bit.ly
	if (txtLongURL.toLowerCase().indexOf("http://bit.ly") >= 0) {
		alert("URL cannot be a bit.ly link. Please enter a different URL.");
		objLongURL.focus();
		return false;
	}
	//validate for valid URL
	var v = new RegExp();
	v.compile("^(http)(s?)\:\/\/((www\.)+[a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;=:%\$#_]*)?");
	if ( (!v.test(txtLongURL)) || (txtLongURL.length <=7) ) {
		alert("You must provide a valid URL.");
		return false;
	}
});

/* Modal *****************************************/
var modalOpen = false;

$('a[rel=modal]').click(function(e) {
	e.preventDefault();
	var id = $(this).attr('href').replace("/","#");
	modalOpen = true;

	// Remember what opened me to focus when closing
	var lastFocus = document.activeElement;

	// Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	// Set height and width to mask to fill up the whole screen
	$('#mask').css('width',maskWidth);
	$('#mask').css('height',maskHeight);
	
	// Transition effect - mask
	$('#mask').fadeIn(500);

	// Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();

	// Position the popup window to center
	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2-20);

	// Position the close button
	var modalLeft = ( $(id).width() + 20 ) + "px";
	$(".close").css('top',  '-.2rem');
	$(".close").css('left', modalLeft);

	// Transition effect and focus the modal
	$(id).fadeIn(500);
	$(id).focus();

	// Close - if close button is clicked
	$('.modal .close').click(function (e) {
		e.preventDefault();
		$('#mask, .modal').hide();
		lastFocus.focus();
		modalOpen = false;
	});

	// Close - if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.modal').hide();
		lastFocus.focus();
		modalOpen = false;
	});

	// Close - Escape key
	$(document).on('keydown', function (e) {
	    if (e.keyCode === 27) { // ESC
			$('#mask, .modal').hide();
			lastFocus.focus();
			modalOpen = false;
	    }
	});
});
// Resize modal when window resized
$(window).resize(function () {
	var id = $('.modal');

	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	// Set height and width to mask to fill up the whole screen
	$('#mask').css('width',maskWidth);
	$('#mask').css('height',maskHeight);

	// Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();

	// Position the popup window to center
	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2-20);

	// Position the close button
	var modalLeft = ( $(id).width() + 20 ) + "px";
	$(".close").css('top',  '-.2rem');
	$(".close").css('left', modalLeft);
});
// Maintain focus within modal
document.addEventListener("focus", function(event) {
	var modal = document.getElementById("search_quick");
	if (modalOpen && !modal.contains(event.target)) {
		event.stopPropagation();
		modal.focus();
	}
	var modal2 = document.getElementById("go_to_user");
	if (modalOpen && !modal2.contains(event.target)) {
		event.stopPropagation();
		modal2.focus();
	}
}, true);



