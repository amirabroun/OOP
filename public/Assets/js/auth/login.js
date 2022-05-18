$('#signin_form').on('submit', function (event) {
    event.preventDefault();
    const username = $(this).find("input[name='username']").val();
    const password = $(this).find("input[name='password']").val();
    $.ajax({
        url: '/routes/web.php',
        dataType: 'json',
        method: 'post',
        data: {
            username: username,
            password: password,
            grecaptcha: grecaptcha.getResponse(),
            action: 'admin_login',
        },
        success: function (response) {
            Swal.fire({
                title: response.message.title,
                html: response.message.text,
                icon: response.message.type,
                buttonsStyling: false,
                confirmButtonText: response.confirmButtonText,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(function (done) {
                if (done.isConfirmed === true && response.status === 200) {
                    window.location.reload();
                }
            });
        }
    });
});