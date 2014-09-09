// progress bar function
function progressBar() {
	$("progress").val(0).show(0,function(){
		var myvar =	setInterval(function(){
			var pro = $("progress");
			var current = pro.val();
			var next = current + 1;
			pro.val(next);
			if( current > 100) {
			clearInterval(myvar)};},500);
	});
}



//Mainload function
function mainLoad( elem , page) {

	$(elem).click(function(){
		$('#content').fadeOut(function(){
			$(this).load(page, function(){
				$(this).fadeIn();
				$("progress").val(100).fadeOut();
			});
		});

		progressBar();
	});
};
mainLoad('#home', '/dashboard/welcome/welcome.php');
mainLoad('#schedule', '/dashboard/schedule/index.php');