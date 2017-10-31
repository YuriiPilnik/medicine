$(document).ready(function() {
$(function() {
	$("#dialog").dialog({
		autoOpen: true,
		resizable: false,
		width: 600,
		height: 600,
		modal: false, 
		buttons: {
		  "CANCEL": function() { 
		    window.location.replace("http://ya.ru");
		  } 
		},
		// close: function() {
		//   window.location.replace("http://www.google.com");
		// }
	});
$("#image").on("click", function() {
	window.location.replace("https://www.youtube.com/");
});
});
});
