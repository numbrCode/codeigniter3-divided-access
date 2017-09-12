<?php
/*
 * This file is the default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Divided_access_controller extends CI_Controller {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		
			///* вывод ВСЕХ ошибок на экран (http://phpfaq.ru/sessions) */
			//ini_set('display_errors',1);
			//error_reporting(E_ALL);
		
		/* Loading this Helper */
		$this->load->helper('url');
		
		/* Loading the own library (An example of using the own library) */
		$this->load->library('own_library');
		
		/* Loading the helper 'COOKIE' (An example of using the COOKIEs) */
		$this->load->helper('cookie');
		
		/* Loading the session library (An example) */
		$this->load->library('session');
		
		$this->load->model('divided_access_model');
	}

	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/tabs_sms_webmoney
	 *	- or -
	 * 		http://example.com/index.php/codeigniter313_guestbook/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/codeigniter313_guestbook/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 *
	 * @return	void
	 */
	public function index()
	{
			//$this->session->set_userdata('access', 'yes');		/* Разрешение доступа. Установка флага доступа в сессии */
			//$this->session->unset_userdata('access');					/* Запрет доступа. Сброс флага доступа в сессии */
		$access = $this->session->access;
			//echo '$access = '.$access.'<br>';
		
		if($access == NULL)			/* Да. Доступ запрещён. (В начале пути) */
		{
			$this->access_no();
				//$this->session->set_userdata('access', 'yes');		/* Разрешение доступа. Установка флага доступа в сессии */
		}
		
		if($access == 'yes')		/* Да. Доступ разрешён (после успешной авторизации) */
		{
			$this->access_yes();
				//$this->session->unset_userdata('access');					/* Запрет доступа. Сброс флага доступа в сессии */
		}
	}


	/**
	 * If there is NO access
	 * (Если доступа НЕТ)
	 *
	 * @return	void
	 */
	protected function access_no()
	{
		//echo 'private function access_no()<br>';

		/* (An example of using the own library) */
		/* Заголовок для тэга <title> */
		$data['title'] = 'Форма входа | '.$this->own_library->get_title();
		
		/* Подгружаем view login_password_view.php */
		$data['content'] = $this->load->view('themes/starter_template/login_password_view', '', TRUE);
		
		/* Основной view */
		$this->load->view('themes/starter_template/divided_access_view', $data);
	}


	/**
	 * If access is allowed
	 * (Если доступ разрешён)
	 *
	 * @return	void
	 */
	protected function access_yes()
	{
		//echo 'private function access_yes()<br>';
		
			//echo'$_SESSION = '."\n<pre>";
				//print_r($_SESSION);
			//echo'</pre>';

			//$this->session->unset_userdata('access');					/* (Debug). Запрет доступа. Сброс флага доступа в сессии */
			
		/* Заголовок для тэга <title> */
		$data['title'] = 'Разделённый доступ | '.$this->own_library->get_title();

		/* Получить левое меню */
		$page_content['left_menu'] = $this->get_left_menu();
		
		/* Получить содержание первой страницы группы */
		$page_content['content_first_page_group'] = $this->get_content_first_page_group();

		/* Подгружаем view content_divided_access_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		$data['content'] = $this->load->view('themes/starter_template/content_divided_access_view', $page_content, TRUE);
		
		/* Основной view */
		$this->load->view('themes/starter_template/divided_access_view', $data);
	}


	/**
	 * Get the left menu
	 * (Получить левое меню)
	 *
	 *
	 * @return	string (view)
	 */
	protected function get_left_menu()
	{
			//echo'$_SESSION = '."\n<pre>";
			//	print_r($_SESSION);
			//echo'</pre>';
			
			//echo'$_SESSION["pages_group_access"] = '."\n<pre>";
			//print_r($_SESSION['pages_group_access']);
			//echo'</pre>';
	
		$data_menu['pages_group_access'] = $this->session->userdata('pages_group_access');
			//echo'$data_menu["pages_group_access"] = '."\n<pre>";
			//	print_r($data_menu['pages_group_access'] );
			//echo'</pre>';
			
		//$data_menu['names_pgs'] = $this->session->userdata('names_pgs');
		//	echo'$data_menu["names_pgs"] = '."\n<pre>";
		//		print_r($data_menu['names_pgs'] );
		//	echo'</pre>';
		
		/* Подгружаем view left_menu_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		return $this->load->view('themes/starter_template/left_menu_view', $data_menu, TRUE);
	}


	/**
	 * Get the contents of the first page of the group
	 * (Получить содержание первой страницы группы)
	 *
	 *
	 * @return	string (view)
	 */
	protected function get_content_first_page_group()
	{
			//echo'$_SESSION = '."\n<pre>";
			//	print_r($_SESSION);
			//echo'</pre>';

		$name_first_page = $this->session->userdata('name_first_page');
		
		/* Содержание названной страницы */
		$name_first_page_group = $this->divided_access_model->read_content_named_page($name_first_page);
			//echo "\n<pre>".'$name_first_page_group = ';
			//	print_r($name_first_page_group);
			//echo "<pre>\n";

		$data_page['content_page'] = $name_first_page_group;
		
		/* Подгружаем view content_page_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		return $this->load->view('themes/starter_template/content_page_view', $data_page, TRUE);
	}


	/**
	 * Exit of the divided access
	 * (Выход из разделённого доступа)
	 *
	 * @return	void
	 */
	public function exit_content_divided_acces()
	{
		echo 'public function exit_content_divided_acces()';

		/* Запрет доступа. Сброс флага доступа в сессии */
		$this->session->unset_userdata('access');

		/* Переход на главную страницу */
			//header( "Location: ".$_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']);
			/* https://www.codeigniter.com/user_guide/helpers/url_helper.html?highlight=redirect#redirect */
		// with 301 redirect
		//redirect('/article/13', 'location', 301);
		redirect(($_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']), 'location');
	}	
	
	
	/**
	 * Access check (blank)
	 * (Проверка доступа) (заготовка)
	 *
	 * @return	void
	 */
	protected function access_check()
	{
		echo 'protected function access_check()<br>';
	}
	
	
}
