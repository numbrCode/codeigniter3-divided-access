<?php
/*
 * This file is the class of own library
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Own_library {

	/**
	 * The salt for password
	 * (Соль для пароля)
	 *
	 * @var	string
	 */
	public $salt = 'panda';

	
	/**
	 * Check connection library
	 * (Проверить подключение библиотеки)
	 *
	 * @return	void
	 */
	public function own_library_function()
	{
		echo "(Own_library.php) : public function own_function()\n";		/* $this->own_library->own_function(); */
	}


	/**
	 * Title for tag <title>
	 * (Заголовок для тэга <title>)
	 *
	 * @return	string
	 */
	public function get_title()
	{
		$title = 'Пример простого разделённого доступа на php-framework CodeIgniter 3 + MySQL + AJAX (jQuery) +  css-fw Bootstrap 3.';
		return $title;
	}


	/**
	 * One-way string hashing
	 * (Необратимое хэширование строки)
	 * 
	 * @param	string	Password
	 * @param	string 	The salt for password
	 * 
	 * @return	string	Hash of password
	 */
	public function set_hash_password($password, $salt)
	{
		// Получение хэша, соль генерируется автоматически
		/* crypt() — Необратимое хэширование строки */		
		return crypt($password, $salt);
	}

	
	/**
	 * Generating a password hash using the specified salt
	 * (Генерация хэша пароля с использованием заданной соли)
	 * 
	 * @param	string	Password
	 * @param	string 	The salt for password
	 * 
	 * @return	void
	 */
	public function generate_hash_password()
	{
		$password = '123456';		/* paa5KD6arxLr2 */		/* public $salt = 'panda'; */
		//$password = '123';			/* paN8aiEIonqJE */		/* public $salt = 'panda'; */
		$password_hash = $this->set_hash_password($password, $this->salt);
		echo '$password = '.$password.' : $password_hash = '.$password_hash."\n";
	}
	

	/**
	 * Names of pages
	 * (Названия страниц)
	 *
	 * @return	array
	 */
	public function get_names_pages()
	{
		$names_pages = array(
												 '1' => array('pizza','Пицца','ПИЦЦА','пицца'),
												 '2' => array('dough','Тесто','ТЕСТО','тесто'),
												 '3' => array('rolls','Роллы','РОЛЛЫ','роллы'),
												 '4' => array('rice','Рис','РИС','рис')
												 );

		return $names_pages;
	}
	
	
	/**
	 * Pages by groups of access
	 * (Страницы по группам доступа)
	 *
	 * @param string Number of group
	 * @return	array
	 */
	public function get_pages_group_access($number_group)
	{
		$names_pages = $this->get_names_pages();

		/* Группа '1' по имени 'manager' имеет доступ к страницам 'pizza','ПИЦЦА'; 'dough','ТЕСТО'; 'rolls','РОЛЛЫ'; 'rice','РИС' */
		$pages_group_access['1'] = array(
																			'0' => 'manager',
																			'1' => array(
																									 $names_pages[1][0],		/* 'pizza' */
																									 $names_pages[1][2],		/* 'ПИЦЦА' */
																									),
																			'2' => array(
																									 $names_pages[2][0],
																									 $names_pages[2][2],
																									),
																			'3' => array(
																									 $names_pages[3][0],
																									 $names_pages[3][2],
																									),
																			'4' => array(
																									 $names_pages[4][0],
																									 $names_pages[4][2],
																									)
																		);

		/* Группа '2' по имени 'china' имеет доступ к страницам 'pizza','ПИЦЦА'; 'dough','ТЕСТО' */
		$pages_group_access['2'] = array(
																			'0' => 'china',
																			'1' => array(
																									 $names_pages[1][0],
																									 $names_pages[1][2],
																									),
																			'2' => array(
																									 $names_pages[2][0],
																									 $names_pages[2][2],
																									)
																		);

		/* Группа '3' по имени 'sushi' имеет доступ к страницам 'rolls','РОЛЛЫ'; 'rice','РИС' */
		$pages_group_access['3'] = array(
																			'0' => 'sushi',
																			'1' => array(
																									 $names_pages[3][0],
																									 $names_pages[3][2],
																									),
																			'2' => array(
																									 $names_pages[4][0],
																									 $names_pages[4][2],
																									)
																		);
		
		return $pages_group_access[$number_group];
	}
}
