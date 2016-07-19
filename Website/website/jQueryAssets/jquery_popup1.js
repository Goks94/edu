$(document).ready(function() {

$("#onclick").click(function() {
	$("#contactdiv").css("display", "block");
});

$("#contact #cancel").click(function() {
	$(this).parent().parent().hide();
});
	
// Contact form popup send-button click event.
$("#send").click(function() {
	var title = $("#title").val();
	var datepicker = $("#datepicker").val();
	var message = $("#message").val();
	
	var dataString = 'title='+title+'&datepicker='+datepicker+'&message='+message;
	if (!$('#title').val() || !$('#message').val() || !$('#datepicker').val()) {
		alert("Please fill all the fields!");
	}else{
		$("#contactdiv").css("display", "none");
		// AJAX Code To Send Form.
		$.ajax({
			type: "POST",
			url: "jquery_popup.php",
			data: dataString,
			cache: false,
			success: function(result){
				alert(result);			
			}
		});
	}
	return false;
});

});
