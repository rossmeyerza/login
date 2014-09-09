//callback handler for form submit
$("form").submit(function(e){
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    window.location.assign(formURL);
    e.preventDefault(); //STOP default action
});