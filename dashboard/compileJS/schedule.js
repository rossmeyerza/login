$('select').change(function(){

	var no = ($(this).attr('id')).slice(7,9);
	var name = $('#name').text();
	var opt = $(this).val();

	if (opt != "Please select") {
		var d = new Date();
    	$('#vacDate'+no).val(d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear());
    	$('#sign'+no).val(name);
	} else {
		$('#vacDate'+no).val("");
		$('#sign'+no).val("");
	};
	
})