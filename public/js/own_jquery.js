/*
 * This file is shared file *.js
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */

$(document).ready(function()
{
	//var documentLocalHref = document.location.href.toString();
	// var documentLocalHref = 'https://divided-access.yoursite.com/';
	var documentLocalHref = 'http://ci3-divided-access.loc/';
		console.log('documentLocalHref = '+documentLocalHref);


	/* При нажатии кнопки "Войти" */
	$(".own-bttn-add").on('click', function(e)             
	{
		console.log('Нажата кнопка "Войти".');
		
		/* Проверка Name на правильность */
		var inputObjName = document.getElementById("inputName");
		/* Проверка Password на правильность */
		var inputObjPassword = document.getElementById("inputPassword");

		if (inputObjName.checkValidity() && inputObjPassword.checkValidity())				/* Name is valid AND Password is valid */
		{
			console.log('Вошли в AJAX для "Войти"');
//return;

			/* Для отправки JSON 'name' и 'password' по AJAX */
			var messageBrowser = {"name":$('#inputName').val(), "password":$('#inputPassword').val()} 
				//console.log('messageBrowser = '+messageBrowser);
	
			/* Действие события по умолчанию не будет выполнено (<button id="ownBtnSbmt" type="submit" class="btn btn-primary own-bttn-add">Добавить комментарий</button>) */
			e.preventDefault();

			/* Отправляем AJAX */
			$.ajax (
			{
				method : "POST",
					//url: documentLocalHref+'index.php/ajax_query/ajax_test',			/* To test AJAX */
				url: documentLocalHref+'index.php/ajax_query/ajax_check_name_password',
				cache: false,
				data: messageBrowser,
				error: function (jqXHR, exception)
				{
					console.log('button LogIn - AJAX error: jqXHR.status = ' + jqXHR.status + '\n');
					console.log('button LogIn - AJAX error: exception = ' + exception + '\n');
				},
				success: function(messageServer)   /* из index.php/codeigniter313_guestbook/add_comment_ajax */
				{
					console.log("button LogIn - AJAX success:\n" + 'messageServer = ' + messageServer);
						//console.log("button LogIn - AJAX success:\n" + 'JSON.parse(messageServer["success"]) = '+JSON.parse(messageServer)['success']);
					
					/* Доступ к DB разрешён */
					if(JSON.parse(messageServer)['success'] == 'yes')
					{
						console.log('Упешный доступ');
						/* Для /application/views/themes/starter_template/login_password_view.php */
						$(".own-ajax-ask").addClass('hidden');
						
						/* Пересылаем на страницу 'Форма входа' */
								//window.location.href = location.href+"admin/";
                window.location.href = documentLocalHref;
					}
					
					/* Доступ к DB запрещён */
					if(JSON.parse(messageServer)['success'] == 'no')
					{
						console.log('Доступ НЕ удался');

						/* Для /application/views/themes/starter_template/login_password_view.php */
						if ($(".own-ajax-ask").hasClass("hidden"))
						{
							$(".own-ajax-ask").removeClass('hidden');
						}
					}
				}
			});
		}
	});	/* ./При нажатии кнопки "Войти" */


	/* При нажатии кнопки левого меню ссылки на страницу (например"pizza") */
	$(".own-name-page").on('click', function(e)             
	{
		var namePage = $(this).data('ownNamePage');
		console.log('Нажата кнопка левого меню ссылки на страницу: namePage = ' + namePage);			/* 'pizza' */
			//$(selector).data('fooBar', baz).attr('data-foo-bar', baz);
		
		/* Отправляем AJAX */
		$.ajax (
		{
			method : "POST",
				//url: documentLocalHref+'index.php/ajax_query/ajax_test',			/* To test AJAX */
			url: documentLocalHref+'index.php/ajax_query/ajax_named_page',
			cache: false,
			data: '&name_page=' + namePage,
			error: function (jqXHR, exception)
			{
				console.log('button of Left-menu - AJAX error: jqXHR.status = ' + jqXHR.status + '\n');
				console.log('button of Left-menu - AJAX error: exception = ' + exception + '\n');
			},
			success: function(messageServer)   /* из index.php/codeigniter313_guestbook/add_comment_ajax */
			{
				//console.log("button of Left-menu - AJAX success:\n" + 'messageServer = ' + messageServer);
				//console.log("button of Left-menu - AJAX success:\n" + 'JSON.parse(messageServer["success"]) = '+JSON.parse(messageServer)['success']);
					
				/* Да. Для обновлениея содержания страницы всё готово */
				if(JSON.parse(messageServer)['success'] == 'yes')
				{
					console.log('Упешный переход по AJAX на '+namePage);
					
					/* Обнрвляем содержание страницы */
						//console.log("button of Left-menu - AJAX success:\n" + 'JSON.parse(messageServer)["content_page"] = ' + JSON.parse(messageServer)['content_page']);
					document.getElementById("own-content-page").innerHTML = JSON.parse(messageServer)['content_page'];
					
					/* Обновляем the left menu */
					/* Удалить .own-current из .own-current */
					$(".own-current").removeClass('own-current');
					/* Удалить .glyphicon-hand-right из .glyphicon-hand-right и добавить туда же 'glyphicon-thumbs-up' */
					$(".glyphicon-hand-right").removeClass('glyphicon-hand-right').addClass('glyphicon-thumbs-up');
					
					/* Добавить .own-current в нажатую ссылку левого меню */
					$("a[data-own-name-page='"+namePage+"']").addClass('own-current');
					
					/* Удалить из <a class="btn btn-default own-name-page own-current" href="#" role="button" data-own-name-page="dough"><i class="glyphicon glyphicon-thumbs-up"></i> ТЕСТО</a> '.glyphicon-thumbs-up" и добавить туда же 'glyphicon-hand-right' */
					$(".own-current>i").removeClass('glyphicon-thumbs-up').addClass('glyphicon-hand-right');
				}
			}
		});	/* ./Отправляем AJAX */
	});
	/* ./При нажатии кнопки левого меню ссылки на страницу "pizza" */
	
	
	/* При нажатии элемента из списка 'Поиска' ('Search') (<li class="own-li-search">111111. pizza1, Пицц</li>) */
	$('.own-li-search').on('click', function()
	{
		console.log('listSearchClick()');
		console.log('\$(".own-li-search").text() = ' + $('.own-li-search').text());
	});
	/* ./При нажатии элемента из списка 'Поиска' ('Search') */
	
	
	/* Клавиша отжата в <input type="text" class="form-control own-inpt-search" placeholder="Сквозной поиск от 3-х символов..."> Search */
	$('.own-inpt-search').on('keyup', function()
	{
	  inputValue = $('.own-inpt-search').val();
			//console.log('inputValue = ' + inputValue);
		if (inputValue.length >= 3)						/* Да. Введено з и больше символов */
		{
			//console.log('inputValue = ' + inputValue + ', inputValue.length = '+inputValue.length);
			console.log('Вход в AJAX for Search');
			
			/* Посылаем AJAX */
			$.ajax (
			{
				method : "POST",
					//url: documentLocalHref+'index.php/ajax_query/ajax_test',			/* To test AJAX */
				url: documentLocalHref+'index.php/ajax_query/ajax_input_search',
				cache: false,
				data: '&input_value=' + inputValue,
				error: function (jqXHR, exception)
				{
					console.log('list of Search - AJAX error: jqXHR.status = ' + jqXHR.status + '\n');
					console.log('list of Search - AJAX error: exception = ' + exception + '\n');
				},
				success: function(messageServer)   /* из index.php/codeigniter313_guestbook/add_comment_ajax */
				{
					//console.log("list of Search - AJAX success:\n" + 'messageServer = ' + messageServer);
					//console.log("list of Search - AJAX success:\n" + 'JSON.parse(messageServer["success"]) = '+JSON.parse(messageServer)['success']);
					//console.log("list of Search - AJAX success: "+'inputValue = ' + inputValue + "| inputValue.length = "+inputValue.length);

					/* Да. Для обновлениея содержания страницы всё готово */
					if(JSON.parse(messageServer)['success'] == 'yes') {
						console.log('list of Search - AJAX success: Получен через AJAX список Search for ' + inputValue);
						
						/* Обновляем содержание страницы */
							//console.log("list of Search - AJAX success:\n" + 'JSON.parse(messageServer)["content_page"] = ' + JSON.parse(messageServer)['content_page']);
						document.getElementById("own-dv-search").innerHTML = JSON.parse(messageServer)['content_page'];
						
						/* Вешаем обработчик на не существующий пока элемент */
						$('body').delegate(".own-li-search", "click", function (event)
						{
							//console.log('\$(".own-li-search").text() = ' + $('.own-li-search').text());
							//console.log('\$(".own-li-search").text() = ' + $(this).text());
							/* Результат 'Search' */
							var rezlt_search = $(this).text();
							console.log('rezlt_search = ' +rezlt_search);
							$('.own-inpt-search').val(rezlt_search);
							/* Добавить .hidden (скрыть) список 'Search' */
							$(".own-ul-search").addClass('hidden');
						});
					}
				}
			});	/* ./Посылаем AJAX */
		}
	});
	/* ./<input type="text" class="form-control" placeholder="Ввод для поиска..."> Search */


	/* При нажатии кнопки 'Поиск' */
	$('.own-button-search').on('click', function()
	{
		console.log('Нажата button "Поиск"');
		/* Значение строки поиска (<input>) */
		var inputSearch =$('.own-inpt-search').val();
		//console.log('inputSearch = ' + inputSearch);
		
		if (inputSearch.length >= 3)						/* Да. Введено з и больше символов */
		{
			console.log('inputSearch = ' + inputSearch);
		/* Посылаем AJAX */
			$.ajax (
			{
				method : "POST",
					//url: documentLocalHref+'index.php/ajax_query/ajax_test',			/* To test AJAX */
				url: documentLocalHref+'index.php/ajax_query/ajax_button_search',
				cache: false,
				data: '&input_search=' + inputSearch,
				error: function (jqXHR, exception)
				{
					console.log('button of Search - AJAX error: jqXHR.status = ' + jqXHR.status + '\n');
					console.log('button of Search - AJAX error: exception = ' + exception + '\n');
				},
				success: function(messageServer)   /* из index.php/codeigniter313_guestbook/add_comment_ajax */
				{
					//console.log("button of Search - AJAX success:\n" + 'messageServer = ' + messageServer);
					//console.log("button of Search - AJAX success:\n" + 'JSON.parse(messageServer)["success"]) = '+JSON.parse(messageServer)['success']);
					
					/* Да. Для обновлениея содержания страницы всё готово */
					if(JSON.parse(messageServer)['success'] == 'yes')
					{
						console.log('button of Search - AJAX success: Упешный переход по AJAX на странцу выдачи "Поиска"');

						/* Обнрвляем содержание страницы */
							//console.log("button of Search - AJAX success:\n" + 'JSON.parse(messageServer)["content_page"] = ' + JSON.parse(messageServer)['content_page']);
						document.getElementById("own-content-page").innerHTML = JSON.parse(messageServer)['content_page'];
						
						/* Обновляем the left menu */
						/* Удалить .own-current из .own-current */
						$(".own-current").removeClass('own-current');
						/* Удалить .glyphicon-hand-right из .glyphicon-hand-right и добавить туда же 'glyphicon-thumbs-up' */
						$(".glyphicon-hand-right").removeClass('glyphicon-hand-right').addClass('glyphicon-thumbs-up');
						
						/* Добавить .hidden (скрыть) список 'Search' */
							$(".own-ul-search").addClass('hidden');
					}
				}
			});	/* ./Посылаем AJAX */
		}
	});
	/* ./При нажатии кнопки 'Поиск' */


});
