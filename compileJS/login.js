$('#login-btn').on("click",function(){
	$('#load').fadeOut();
	$("#logo").animate({width: "200px"},500);
	$('#login_form').animate({height: "387px"},500, function() {
		$('#login_form').load('form_login.php');
	});
});

function match() {
	if ( $('#login_password').val() != $('#login_confirm').val() ) {
		$('#match').show('fast');
		$('#lgn-btn').attr('disabled', 'disabled');
	} else {
		$('#match').hide('fast');
		$('#lgn-btn').removeAttr('disabled');
	}
}

$("#login_confirm").keyup(function() {
	match();
});
$("#login_password").keyup(function() {
	match();
});
