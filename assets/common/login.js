function showPassword() {
	var x = document.getElementById("niPassword");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}

$("#btn-login").click(function(event){
	blockUI();
	event.preventDefault();
        //alert(url_login);
	$.ajax({
		url: url_login,  
		type: "POST",
		data: {
			captcha:$("input[name=captcha]").val(),
			username: $("input[name=username]").val(),
			password: $("input[name=password]").val(),
			captcha: $("input[name=captcha]").val()
		},
		dataType: 'json',
		
		success: function(json) {
                        //alert("ajax success");
			if (json.code == 0){
				window.location = json.data;
			}else{
                                 alert(json.message);
				//unblockUI();
				//notif(json.header,json.message,json.theme);
			}
		},

		error: function(json){
                    alert(json.message);
                    ///alert(json.responseText);
			//unblockUI();
			//notif(json.header,json.message,json.theme);
		},

		complete: function(){
                      //alert("ajax complete");
			unblockUI();
		}
	});
});