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
