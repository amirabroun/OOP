"use strict";

$('#signin_form').on('submit', function (event) {
	event.preventDefault();
	const username = $(this).find("input[name='username']").val();
	const password = $(this).find("input[name='password']").val();
	$.ajax({
		url: '/requests/login.php',
		dataType: 'json',
		method: 'post',
		data: {
			username: username,
			password: password,
			grecaptcha: grecaptcha.getResponse(),
			action: 'admin_login',
		},
		success: function (response) {
			if (response.status === 200) {
				Swal.fire({
					title: response.message.title,
					html: response.message.text,
					icon: response.message.type,
					buttonsStyling: false,
					confirmButtonText: "متوجه شدم!",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				}).then(function (done) {
					if (done.isConfirmed === true) {
						window.location.reload();
					}
				});
			} else {
				Swal.fire({
					title: response.message.title,
					html: response.message.text,
					icon: response.message.type,
					buttonsStyling: false,
					confirmButtonText: "متوجه شدم!",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			}
		},
		error: function (response) {
			console.log("Error:", response);
		}
	});
});