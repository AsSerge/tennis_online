jQuery(window).load(function ($) {
	"use strict";
	var $ = jQuery;

	$('#register_form_submit').attr("disabled", true); // Запрещаем кнопку Зарегестрироваться
	$('#recover_password_btn').attr("disabled", true); // Запрещаем кнопку Получить код восстановления
	$('#send_move_btn').attr("disabled", true); // Запрещаем кнопку Отправить ролик
	$('#recover_password_btn').hide();
	$('#newpass').hide();
	// Проверка существования почты при регистрации
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
	// Проверка одинакового пароля
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
	// Проверка логина при восстановлении пароля
	$('#recover_password').on("keyup", function () {
		var check_mail = $('#recover_password').val();
		$.get(
			"./login/check_mail.php", {
				mail: check_mail
			}
		).done(function (data) {
			if (data > 0) {
				$('#recover_password_btn').focus();
				$('#recover_password_btn').show();
				$('#newpass').show();
				// $('#recover_password_btn').attr("disabled", false);
			} else {
				$('#recover_password_btn').hide();
				$('#newpass').hide();
			}
		});
	});

	$('#newpass #user_confirm_password').on("keyup", function () {
		var user_password = $("#user_password").val();
		var user_confirm_password = $("#user_confirm_password").val();
		if (user_password === user_confirm_password) {
			$('#recover_password_btn').attr("disabled", false);
			$('#pass_infotext').text("");
		} else {
			$('#recover_password_btn').attr("disabled", true);
			$('#pass_infotext').text("Пароли не совпадают");
		}
	});
	// Стилизация чек-боксов
	$('.move_check span').on("click", function () {
		var ch = $(this).find('input').prop('checked');
		if (ch == true) {
			$(this).find('input').prop('checked', false);
			// $(this).find('label').css('font-weight', 'normal');
			$(this).find('label').css('background-color', '#b4b4b4');
		}
		if (ch == false) {
			$(this).find('input').prop('checked', true);
			// $(this).find('label').css('font-weight', 'bold');
			$(this).find('label').css('background-color', '#179ed6');
		}
	});
	// Ограничение количества знаков а поле описания
	$('#mov_description').on("keyup", function () {
		var character_number = 200;
		$(this).val($(this).val().slice(0, character_number));

	});

	// Предзагрузка видео на страницу
	$('#move_load').on("blur", function () {
		var long_link = $(this).val();
		if (long_link == '') {
			$('#send_move_btn').attr("disabled", true);
			$('#move_alert_info').html('');
			$('.one_move').html('');
		} else if (GetVideoContentType(long_link) == false) {
			$('#move_alert_info').html('<p style = "color: red; text-align: center;">Извините, мы не поддерживаем ссылки такого типа.<br><a href = "#">Информация по подключению в инструкции</a></p>');
			$('#send_move_btn').attr("disabled", true);
			$('.one_move').html("<iframe src = '../instruction.html' width='100%' height='400px' scrolling='auto'></iframe>");
		} else {
			$('#move_alert_info').html('');
			$('#send_move_btn').attr("disabled", false);

			//***********************************************************
			// выводим загружаемый ролик на страницу (не загружая его в базу)
			$.post(
				'./login/quick_move_view_exe.php', {
					move: long_link
				},
				function (data) {
					$('.one_move').html("<center>" + data + "</center>");
				}
			);
			//***********************************************************
		}
	});
});
// Настройка проверки строки ввода пути к ролику
// vk
// twitter


function GetVideoContentType(long_link) {
	if (/^https:\/\/vimeo.com\//.exec(long_link)) {
		return true;
	} else if (/^https:\/\/www.instagram.com\/p\//.exec(long_link)) {
		return true;
	} else if (/^https:\/\/youtu.be\//.exec(long_link)) {
		return true;
	} else if (/^https:\/\/www.youtube.com\/watch\?v=/.exec(long_link)) {
		return true;
	} else if (/src="https:\/\/www.youtube.com\/embed\//.exec(long_link)) {
		return true;
	} else if (/^https:\/\/www.facebook.com\//.exec(long_link)) {
		return true;
	} else if (/^https:\/\/ok.ru\/video\//.exec(long_link)) {
		return true;
	} else if (/^<iframe src="\/\/vk.com\/video_ext.php/.exec(long_link)) {
		return true;
	} else if (/^<blockquote class="twitter-tweet">/.exec(long_link)) {
		return true;
	} else {
		return false;
	}
}