$('#signup').on("click",function(){
	$('#load').fadeOut();
	$("#logo").animate({width: "150px"},500);
	$('#login_form').animate({height: "580px"},500, function() {
		$('#login_form').load('form_register.php');
	});
});
