jQuery(document).ready(function ($) {
	$('#register_form_submit').attr("disabled", true); // Запрещаем кнопку Зарегестрироваться

	$('#user_mail').on("focusout", function () {

		var check_mail = $('#user_mail').val();
		$.get(
			"./login/check_mail.php", {
				mail: check_mail
			}
		).done(function (data) {
			if (data > 0) {
				$('#mail_infotext').text("Такая почта существует");
				$('#user_mail').val("");
				$('#user_mail').focus();
			} else {
				$('#mail_infotext').text("");
			}
		});
	});

	$('#user_confirm_password').on("keyup", function () {
		var user_password = $("#user_password").val();
		var user_confirm_password = $("#user_confirm_password").val();
		if (user_password === user_confirm_password) {
			$('#register_form_submit').attr("disabled", false);
			$('#pass_infotext').text("");
		} else {
			$('#register_form_submit').attr("disabled", true);
			$('#pass_infotext').text("Пароли не совпадают");
		}
	});
});