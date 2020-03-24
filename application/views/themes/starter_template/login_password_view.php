<?php
/*
 * This file is the view of first page (login & password)
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="container">

		<!--<form class="form-signin" action="/index.php/ajax_query/ajax_test">-->
		<form class="form-signin" id="own-form-login">
			<h2 class="form-signin-heading">Пожалуйста, введите</h2>
			
			<label for="inputName" class="sr-only">Имя</label>
			<input type="text" id="inputName" class="form-control" placeholder="Имя" autofocus required="required" pattern="^[A-Za-zА-Яа-яЁё0-9-.\s]{4,}">
			
			<label for="inputPassword" class="sr-only">Пароль</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="required" pattern="^[A-Za-z0-9-.\s]{3,}">

			<p class="text-danger own-ajax-ask hidden">Извините, авторизация не прошла. Повторите, пожалуйста ввод.</p>
			<button class="btn btn-lg btn-primary btn-block own-bttn-add" type="submit">Войти</button>
		</form>
<br><br><br>
	</div> <!-- /container -->
	<div class="container">
		<ul>
			<li>
				1. https://divided-access.yoursite.ru/
"Форма входа | Пример простого разделённого доступа на php-framework CodeIgniter 3 + MySQL + AJAX (jQuery) +  css-fw Bootstrap 3."
			</li>

			<li>
				2. Длдя повышения безопасности может использоваться протокол https:// .
			</li>

			<li>
				3. СУБД MySQL. Дамп базы данных в /divided_access_.sql
			</li>

			<li>
				4. Проверка по входу:<br>
					4.1. Длина имени >= 4.<br>
					4.2. Длина пароля >= 3.
			</li>

			<li>
				5. Пары логигов и паролей для входа по группам:<br>
					5.1. Группа 1: ('ПИЦЦА', 'ТЕСТО', 'РОЛЛЫ', 'РИС')<br>
				 manager|123456;<br>
					5.2. Группа 2: ('ПИЦЦА', 'ТЕСТО')<br>
				china|123456;<br>
					5.3. Группа 3: ('РОЛЛЫ', 'РИС')<br>
				sushi|123456;
			</li>

			<li>
				6. Дизайн мини web-site выбран типовой для Bootstrap 3.
			</li>	

			<li>
				7. Используются программные продукты:<br>
					7.1. Framework fm-php CodeIgniter 3 (последняя доступная версия).<br>
					7.2. fm-css Bootstrap 3 (последняя доступная версия).<br>
					7.3. СУБД MySQL 5.<br>
					7.4. Всесторонне используются технологии jQuery и AJAX.
			</li>

			<li>
				8. Code licensed under MIT,
			</li>

			<li>
				9. Documentation under CC BY 3.0.
			</li>
		</ul>
	</div> <!-- /container -->