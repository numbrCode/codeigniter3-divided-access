/*
 * This file is shared file *.js
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */

var documentLocalHref = document.location.href.toString();

/* Alert dialogs at jquery-ui */
/**
 * Modal window for alert dialogs at jquery-ui-1.12.1
 * 
 * @return	void
 */
function alertDialogJqUI() {
	if ($("#dialog-jq-ui").hasClass("hidden")){
		$("#dialog-jq-ui").removeClass("hidden");
	}
	$("#dialog-jq-ui").dialog({
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog("close");
			}
		}
	});
};

/**
 * Alert dialogs at jquery-ui-1.12.1
 *
 * @param {string} divTitle - <div title="..." ...> (Заголовок модального окна)
 * @param {string} glyphiconAttrib - Type of class glyphicon (Тип класса glyphicon): ok, remove
 * @param {string} textOwnAlert - Text alert of dialog (Текст alert dialog)
 * 
 * @return	void
 */
function alertDialog(glyphiconAttrib, textOwnAlert) {
	if ($("#span-dialog-jq-ui").hasClass("glyphicon-ok")) {
		$("#span-dialog-jq-ui").removeClass("glyphicon-ok");
	}
	if ($("#span-dialog-jq-ui").hasClass("own-glyphicon-ok")) {
		$("#span-dialog-jq-ui").removeClass("own-glyphicon-ok");
	}
	
	if ($("#span-dialog-jq-ui").hasClass("glyphicon-remove")) {
		$("#span-dialog-jq-ui").removeClass("glyphicon-ok");
	}
	if ($("#span-dialog-jq-ui").hasClass("own-glyphicon-remove")) {
		$("#span-dialog-jq-ui").removeClass("own-glyphicon-ok");
	}
	
	var classAdding = "glyphicon-"+glyphiconAttrib;
	var ownClassAdding = "own-glyphicon-"+glyphiconAttrib;
	$("#span-dialog-jq-ui").addClass(classAdding).addClass(ownClassAdding);

	$(".own-alert").text(textOwnAlert);

	alertDialogJqUI();
}
/* ./Alert dialogs at jquery-ui */


/**
 * Delete a comment by click the "Delete" button
 * (Удалить комментарий при нажатии кнопки "Удалить")
 *
 * @param		string
 * @return	string
 */
//function callbackClickBttnDelete(messageID)
function ownClickBttnDelete(messageID)
{
		console.log('Нажата кнопка "Удалить".');

		var deleteComment = false;
		var strConfirm = 'Вы действительно хотите удалить комментарий №'+messageID+'?';
		
		$( function() {
			$("#dialog-confirm").dialog({
				resizable: false,
				height: "auto",
				width: 400,
				modal: true,
				buttons: {
					"Удалить комментарий": function() {
						callbackConfirm(true);					/* Да. Удалить комментарий */
						$(this).dialog("close");
					},
					"Отмена": function() {
						callbackConfirm(false);				/* Нет. НЕ удалять комментарий */
						$(this).dialog("close");
					}
				}
			});
		} );
		$(".own-confirm-question").text(strConfirm);
		
		function callbackConfirm(deleteComment)
		{
			/* Вход в AJAX */
			if (deleteComment)					/* Да. Удалить комментарий */
			{
				console.log('Получено подтверждене для удаления комментарий №'+messageID+'.');
			
				var messageBrowser = 'message_id='+messageID;
		
			/* Отправляем AJAX */
				return $.ajax	(
					{
						method : "POST",
						url: documentLocalHref+'index.php/codeigniter313_guestbook/delete_ajax',
						cache: false,
						data: messageBrowser,
						error: function (jqXHR, exception)
						{
							console.log('callbackConfirm() - AJAX error: jqXHR.status = ' + jqXHR.status + "\n");
							console.log('callbackConfirm() - AJAX error: exception = ' + exception + "\n");
						},
						success: function(messageServer)
						{
							console.log('ownClickBttnDelete(messageID) - AJAX success: messageServer = '+messageServer);
							/* lastIndexOf() возвращает индекс последнего вхождения указанного значения в строковый объект String */
							if(messageServer.lastIndexOf('DeleteMessageYes') > 0)
							{
								/* Изменить видимость комментария (скрыть) */
								$(".own_item[data-messageid-row="+messageID+"]").addClass('hidden');

								var glyphiconAttrib2 = "ok";
								var textOwnAlert2 = 'Комментраий №'+messageID+' успешно удалён.';
								alertDialog(glyphiconAttrib2, textOwnAlert2);
							}
				
							/* lastIndexOf() возвращает индекс последнего вхождения указанного значения в строковый объект String */
							if(messageServer.lastIndexOf('DeleteMessageNo') > 0)
							{
								var glyphiconAttrib = "remove";
								var textOwnAlert = 'Извините, комментраий №'+messageID+' НЕ удалось удалить.';
								alertDialog(glyphiconAttrib, textOwnAlert);
							}
						}  
					}
				);
			} else {
				return ;
			}
		}
}


$(document).ready(function()
{
	/**
	 * Download all comments via AJAX
	 * (Загрузить все комментариев через AJAX)
	 *
	 * @return	string
	 */
	function ownAllCommentsAJAX() {
		var messageBrowser = '';
	
		/* Отправляем AJAX */
		return $.ajax	(
			{
				method : "POST",
				url: documentLocalHref+'index.php/codeigniter313_guestbook/all_comments_ajax',
				cache: false,
				data: messageBrowser,
				error: function (jqXHR, exception)
				{
					console.log('ownAllCommentsAJAX() - AJAX error: jqXHR.status = ' + jqXHR.status + "\n");
					console.log('callbackConfirm() - AJAX error: exception = ' + exception + "\n");
				},
				success: function(messageServer)
				{
					document.getElementById("own_div_ajax").innerHTML = messageServer;
				},
				complete: function (jqXHR, textStatus)
				{
					console.log('ownAllCommentsAJAX() - AJAX complete: jqXHR.status = ' + jqXHR.status + "\n");
					console.log('ownAllCommentsAJAX() - AJAX complete: textStatus = ' + textStatus + "\n");
				}
			}
		);
	}
	
	/* Загрузка всех комментариев через AJAX */
	ownAllCommentsAJAX();

	
	/* Для отладки AJAX. Заполнение значениями полей формы */
	$('.own-h4-debug').text('Добавление комментария (поля заполнены на период отладки и ознакомления):');
	$('#inputName').val('name.  Проба Имени 4564 -45645 Poba.');
	$('#inputEmail').val('email@pro.ba');
	var txtareaComment = "comment.\n<script>\nПроба 43534534.\nPooba Test !!!\n\n</SCRIPT>\n/comment.";
	$('#txtareaComment').val(txtareaComment);
	
	/* <form> "Добавить комментарий" */
	var valueCaptcha;	
	/* Иницмализируем случайные слагаемые for Captcha */
	function initCaptcha() {
		/* Удалить из glyphicon класс glyphicon-ok, удалить glyphicon-remove */
		$("#signCheckCaptcha").removeClass('glyphicon-ok');
		
		var randomValue1 = Math.floor(Math.random()*50);
		var randomValue2 = Math.floor(Math.random()*50);
		valueCaptcha = randomValue1 + randomValue2;	
		$("#labelCaptcha").text(randomValue1 + " + " + randomValue2 + " = ");
		$("#inputCaptcha").val("");
		console.log("Инициализация Captcha\n");
	};
	initCaptcha();

	
	/* При нажатии кнопки "Добавить комментарий" */
	$(".own-bttn-add").on('click', function(e)             
	{
		console.log('Нажата кнопка "Добавить комментарий".');

		var NameYes = false;     /* НЕ правильно. Признак правильности ввода Name. */
		var EmailYes = false;     /* НЕ правильно. Признак правильности ввода Email. */
		var CommentYes = false;     /* НЕ правильно. Признак правильности ввода Comment. */
		var CaptchaYes = false;     /* НЕ правильно. Признак правильности ввода Captcha. */
		var AddYes = false;     /* Запрет. Признак разрешения добавления комментария через AJAX. */

		/* Действие события по умолчанию не будет выполнено (<button id="ownBtnSbmt" type="submit" class="btn btn-primary own-bttn-add">Добавить комментарий</button>) */
		e.preventDefault();
		
		/* Проверка Name на правильность */
		var inputObjName = document.getElementById("inputName");
		/* Предок с классом .form-group, для установления success/error */
		var formGroupName = $("#inputName").parents('.form-group');
		if (inputObjName.checkValidity())                            	/* Name is valid */
		{
			/* Добавить к formGroup класс .has-success, удалить has-error */
			formGroupName.addClass('has-success').removeClass('has-error');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckName").addClass('glyphicon-ok').removeClass('glyphicon-remove');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputNameStatus").text("(success)");
			
			NameYes = true;
		}
		else                                                        	/* Name is NOT valid */
		{
			/* Добавить к formGroup класс .has-error, удалить .has-success */
			formGroupName.addClass('has-error').removeClass('has-success');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckName").addClass('glyphicon-remove').removeClass('glyphicon-ok');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputNameStatus").text("(error)");
			
			NameYes = false;
		}

		/* Проверка Email на правильность */
		var inputObjEmail = document.getElementById("inputEmail");
		/* Предок с классом .form-group, для установления success/error */
		var formGroupEmail = $("#inputEmail").parents('.form-group');
		if (inputObjEmail.checkValidity())                            /* Email is valid */
		{
			/* Добавить к formGroup класс .has-success, удалить has-error */
			formGroupEmail.addClass('has-success').removeClass('has-error');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckEmail").addClass('glyphicon-ok').removeClass('glyphicon-remove');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputEmailStatus").text("(success)");
			
			EmailYes = true;
		}
		else                                                        	/* Email is NOT valid */
		{
			/* Добавить к formGroup класс .has-error, удалить .has-success */
			formGroupEmail.addClass('has-error').removeClass('has-success');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckEmail").addClass('glyphicon-remove').removeClass('glyphicon-ok');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputEmailStatus").text("(error)");

			EmailYes = false;
		}

		/* Проверка Comment на правильность */
		var inputObjComment = document.getElementById("txtareaComment");
		/* Предок с классом .form-group, для установления success/error */
		var formGroupComment = $("#txtareaComment").parents('.form-group');
		if (inputObjComment.checkValidity())                           /* Comment is valid */
		{
			/* Добавить к formGroup класс .has-success, удалить has-error */
			formGroupComment.addClass('has-success').removeClass('has-error');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckComment").addClass('glyphicon-ok').removeClass('glyphicon-remove');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#txtareaCommentStatus").text("(success)");

			CommentYes = true;
		}
		else                                                        	/* Comment is NOT valid */
		{
			/* Добавить к formGroup класс .has-error, удалить .has-success */
			formGroupComment.addClass('has-error').removeClass('has-success');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckComment").addClass('glyphicon-remove').removeClass('glyphicon-ok');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#txtareaCommentStatus").text("(error)");
			
			CommentYes = false;
		}

		/* Проверка Captcha на правильность */
		var inputObjCaptcha = document.getElementById("inputCaptcha");
		/* Предок с классом .form-group, для установления success/error */
		var formGroupCaptcha = $("#inputCaptcha").parents('.form-group');
		if (valueCaptcha == $("#inputCaptcha").val())                      			/* Captcha is valid */
		{
			/* Добавить к formGroup класс .has-success, удалить has-error */
			formGroupCaptcha.addClass('has-success').removeClass('has-error');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckCaptcha").addClass('glyphicon-ok').removeClass('glyphicon-remove');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputCaptchaStatus").text("(success)");

			CaptchaYes = true;
		}
		else                                                        						/* Captcha is NOT valid */
		{
			/* Добавить к formGroup класс .has-error, удалить .has-success */
			formGroupCaptcha.addClass('has-error').removeClass('has-success');
			/* Добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove */
			$("#signCheckCaptcha").addClass('glyphicon-remove').removeClass('glyphicon-ok');
			/* Для вспомогательных технологий - например, включает в себя дополнительный контент, визуально скрытый с .sr-only */
			$("#inputCaptchaStatus").text("(error)");
			
			CaptchaYes = false;
		}

		/* Проверка разрешений для AJAX */
		if (NameYes && EmailYes && CommentYes && CaptchaYes) 					/* Да. Добавить комментарий через AJAX */
		{
			AddYes = true;
			console.log('AJAX для "Добавить комментарий" разрешён.');
		}
		else                                                					/* Нет. НЕ добавлять комментарий через AJAX */
		{
			AddYes = false;
			//AddYes = true;
			console.log('AJAX для "Добавить комментарий" запрещён.');
		}

		/* Вход в AJAX "Добавить комментарий" */
		if (AddYes)                 /* Да. Добавить комментарий */
		{
			console.log('Вошли в AJAX для "Добавить комментарий"');
	
			/* Упорядочивает набор элементов <form> ввода input в строку данных. */
			var messageBrowser = $('#formCommentQwn').serialize();
	
			/* Отправляем AJAX */
			return $.ajax (
				{
					method : "POST",
					url: documentLocalHref+'index.php/codeigniter313_guestbook/add_comment_ajax',
					cache: false,
					data: messageBrowser,
					error: function (jqXHR, exception)
					{
						console.log('button Add comment - AJAX error: jqXHR.status = ' + jqXHR.status + "\n");
						console.log('button Add comment - AJAX error: exception = ' + exception + "\n");
					},
					success: function(messageServer)   /* из index.php/codeigniter313_guestbook/add_comment_ajax */
					{
						console.log('button Add comment - AJAX success: messageServer = '+messageServer);
						/* lastIndexOf() возвращает индекс последнего вхождения указанного значения в строковый объект String */
						if(messageServer.lastIndexOf('AddCommentYes') > 0)
						{
							var glyphiconAttrib = "ok";
							var textOwnAlert = 'Новый комментарий успешно добавлен.';
							alertDialog(glyphiconAttrib, textOwnAlert);
							
							/* После успешного добавления комментария заново инициализмруем Captcha */
							initCaptcha();
							
							/* Загрузка всех комментариев через AJAX */
							ownAllCommentsAJAX();
						}
					}
				}
			);
		}
	});
	/* При нажатии кнопки "Добавить комментарий" */
	/* ./<form> "Добавить комментарий" */

});
