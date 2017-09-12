<?php
/*
 * This file is the default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_query extends CI_Controller {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		
		/* Loading the own library (An example of using the own library) */
		$this->load->library('own_library');
		
		/* Loading the helper 'COOKIE' (An example of using the COOKIEs) */
		$this->load->helper('cookie');
		
		/* Loading the session library (An example) */
		$this->load->library('session');
		
		/* Loading the model */
		$this->load->model('divided_access_model');
	}	/* ./Class constructor */
	

	/**
	 * Test AJAX
	 * (Проверка AJAX)
	 *
	 * @return	void
	 */
	public function ajax_test()
	{
		echo 'public function ajax_test()'."\n";
		
		echo'$_POST = ';
		print_r($_POST);
	}	/* ./Test AJAX */


	/**
	 * By AJAX to check name and password
	 * (AJAX для проверки имени и пароля)
	 *
	 * @return	JSON		(echo)
	 * @return	void
	 */
	public function ajax_check_name_password()
	{
		//echo 'public function ajax_check_name_password()'."\n";
		
		/* Доступ НЕ удачен */
		$success = 'no';
		
			///* Запрет доступа. Сброс флага доступа в сессии */
			//$this->session->unset_userdata('access');
		
		/* trimed $_POST[] */
		$pst = array(
			'name' => $this->input->post('name'),
			'password' => $this->input->post('password')
		);
			//echo'$pst = ';
			//print_r($pst);


			///* (!) Генерация хэша пароля с использованием заданной соли (!) */
			//$this->own_library->generate_hash_password();

			
		/* Получить все имена, пароли и группы from DB */
		$access_array = $this->divided_access_model->read_access_all();
			//echo "\n".'$access_array = '."\n";
			//print_r($access_array);

		foreach($access_array as $key=>$value)
		{
				//echo '$value["log_access"] = '.$value["log_access"]."\n";
			if($pst["name"] == $value["log_access"])												/* Да. Присланное имя по AJAX есть в базе */
			{
				//echo "\n".'$pst["name"] = '.$pst["name"]."\n";
				
				/* Для проверки пароля в качестве параметра salt следует передавать результат работы
				crypt() целиком во избежание проблем при использовании различных
				алгоритмов (как уже было отмечено выше, стандартный DES-алгоритм
				использует 2-символьную соль, а MD5 - 12-символьную. */
				if (hash_equals($value["passw_access"], crypt($pst["password"], $this->own_library->salt)))		/* Да. Хэши паролей совпадают */
				{
					//echo 'Пароль верен!'."\n";
					//echo 'Пароль верен : '.'$pst["password"] = '.$pst["password"]."\n";
					
					/* Записываем в сессию 'Доступ разрешён' */
					$this->session->set_userdata('access', 'yes');
						//echo '$this->session->access = '.$this->session->access."\n";
						
					/* Записываем в сессию 'Номер группы" (Например: '2') */
					$this->session->set_userdata('group_access', $value["group_access"]);
						//echo '$this->session->group_access = '.$this->session->group_access."\n";
					
					/* id пользователя in DB */
					$this->session->set_userdata('id_access', $value["id_access"]);
						//echo '$this->session->id_access = '.$this->session->id_access."\n";
					
					/* Имя пользователя in DB */
					$this->session->set_userdata('log_access', $value["log_access"]);
						//echo '$this->session->log_access = '.$this->session->log_access."\n";
					
					/* Массив имён страниц для контролера (English) */
					$pages_group_access = $this->own_library->get_pages_group_access($this->session->group_access);
						//echo '$pages_group_access[] = \n';
						//print_r($pages_group_access);
					$this->session->set_userdata('pages_group_access', $pages_group_access);
					
					/* Название первой страницы группы 'pizza' */
					$name_first_page = $this->session->userdata('pages_group_access')['1']['0'];
						//echo "\n\$_SESSION['pages_group_access']['1']['0'] = ".$_SESSION['pages_group_access']['1']['0']."\n";
						//echo "\n \$name_first_page = ".$name_first_page."\n";
					$this->session->set_userdata('name_first_page', $name_first_page);
						//echo "\n \$this->session->userdata('name_first_page') = ".$this->session->userdata('name_first_page')."\n";

					
					/* Доступ успешен */
					$success = 'yes';
					
				}
				break;
			}
		}
		
			///* Служебная конструкция, чтобы "не фонило" */
			//if(empty($pages_group_access))			/* Да. Переменная пустая */
			//{
			//	$pages_group_access = 'empty';		/* Пусто */
			//}
			//$messageServer = array('success' => $success, 'pages_group_access' => $pages_group_access);
			
		$messageServer = array('success' => $success);
		 //print_r($messageServer);
		 
		echo json_encode($messageServer);
	}	/* ./AJAX для проверки имени и пароля */

	
	/**
	 * Through AJAX to form the contents of the selected page
	 * (Через AJAX формировать содержимое выбранной страницы)
	 *
	 * @return	JSON		(echo)
	 * @return	void
	 */
	public function ajax_named_page()
	{
			//echo 'public function ajax_named_page()'."\n";
		
		/* Доступ НЕ удачен */
		$success = 'no';
		
		/* trimed $_POST[] */
		$pst = array(
			'name_page' => $this->input->post('name_page'),
		);
			//echo'$pst = ';
			//print_r($pst);
			

		$name_page = $pst['name_page'];
			//echo "\n".'$named_page = '.$named_page."\n";
		
		/* toDo Проверить, что страница по $_POST разрешена к доступу */
		
		/* Массив с содержанием названной страницы */
		$get_content_named_page	= $this->divided_access_model->read_content_named_page($name_page);

		$data_page['content_page'] = $get_content_named_page;
		
		/* Подгружаем view content_page_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		$messageServer['content_page'] = $this->load->view('themes/starter_template/content_page_view', $data_page, TRUE);
		
		/* Доступ успешен */
		$success = 'yes';
		
		$messageServer['success'] = $success;
			//echo "\n \$messageServer = ";
			//	print_r($messageServer);
		
		echo json_encode($messageServer);
	}	/* ./Через AJAX формировать содержимое выбранной страницы */

	
	/**
	 * By AJAX to form the contents of a list of 'Search'
	 * (Посредством AJAX формировать содержимое списка 'Search')
	 *
	 * @return	JSON		(echo)
	 * @return	void
	 */
	public function ajax_input_search()
	{
			//echo 'public function ajax_named_page()'."\n";
		
		/* Доступ НЕ удачен */
		$success = 'no';

		/* (string) Набираемая строка в <input> 'Search' */
		$input_value = $this->input->post('input_value');
			//echo "\n".'$input_value = '.$input_value;
		
		/* Читать все статьи из table 'articles' (массив) */
		$articles_all = $this->divided_access_model->read_articles_all();
			//echo "\n\$articles_all = ";
			//print_r($articles_all);
		
			//echo "\n".'$_SESSION["pages_group_access"] = ';
			//print_r($_SESSION['pages_group_access']);
			//echo "\n \$_SESSION['pages_group_access']['1']['0'] = ".$_SESSION['pages_group_access']['1']['0']."\n";
		/* (array) Названия доступных страниц */
		$session_pages_access = $this->session->pages_group_access;
			//echo "\n \$session_pages_access = ";
			//	print_r($session_pages_access);
		
		/* Отбор доступных старниц */
		foreach($session_pages_access as $key_session_pages_access => $value_session_pages_access)
		{
			if($key_session_pages_access != 0)				/* Да. НЕ первый (нулевой) элемент */
			{
				/* (array) Доступные страницы */
				$pages_access[] = $value_session_pages_access['0'];
			}
		}
			//echo "\n\$pages_access = ";
			//	print_r($pages_access);
		
		/* Отбор статей из доступных страниц */
		/* Проход по всем доступным страницам */
		foreach($articles_all as $value_articles_all)
		{
			/* Проход по всем доступным страницам */
			foreach($pages_access as $value_pages_access)
			{
				if($value_articles_all['page'] == $value_pages_access)
				{
					/* (array) Все доступные статьи */
					$all_articales_access[] = $value_articles_all;
				}
			}
		}
			//echo "\n\$all_articales_access = \n";
			//	print_r($all_articales_access);
			//echo "\n".'count($all_articales_access) = '.count($all_articales_access)."\n";

		/* Инициализация. (array) Найденные доступные статьи, имеющие набираемую строку поиска */
		$find_articles_with_input_search = array();
		/* Проход по всем доступным стаьям */
		foreach($all_articales_access as $value_all_articales_access)
		{
				//echo $value_all_articales_access['article']."\n";
			
			/* Находим вхождение(я) из набираемой строки поиска в текущей статье */
				///* mb_stripos() — Регистронезависимый поиск позиции первого вхождения одной строки в другую (Многобайтные строки) */
				//$pos = mb_stripos($value_all_articales_access['article'], $input_value);
			/* mb_strpos() — Поиск позиции первого вхождения одной строки в другую (Многобайтные строки) */
			$pos = mb_strpos($value_all_articales_access['article'], $input_value);
				//echo"\n\$pos = ".$pos."\n";
			
			if ($pos !== false)  /* Да. (Нет НЕ верно). Найдено первое вхождение строки */
			{
					//echo "Строка $input_value найдена в строке ".$value_all_articales_access['article'];
					//echo " в позиции $pos";
				
				/* (array) Строка без символа конца строки ($str_wihtout_eol['0']) */
				/* explode() — Разбивает строку с помощью разделителя */
				$str_wihtout_eol = explode(PHP_EOL, $value_all_articales_access['article']);
					//echo "\n\$str_wihtout_eol['0'] = ".$str_wihtout_eol['0'];
				
				/* mb_substr() — Возвращает часть строки (Многобайтные строки) */
				/* (array) Найденные доступные статьи, имеющие набираемую строку поиска */
				/* str_replace() — Заменяет все вхождения строки поиска на строку замены (LF заменяет на 'пробел') */
				//$find_articles_with_input_search[] = str_replace(PHP_EOL, ' ', mb_substr($value_all_articales_access['article'], $pos, '12'));
				$find_articles_with_input_search[] = mb_substr($str_wihtout_eol['0'], $pos, '20');
			}
		}
			//echo "\n\$find_articles_with_input_search = ";
			//	print_r($find_articles_with_input_search);
			//echo "\n".'count($find_articles_with_input_search) = '.count($find_articles_with_input_search)."\n";

		$data_list['find_articles_with_input_search'] = $find_articles_with_input_search;
		
		$count_find_articles_with_input_search = count($find_articles_with_input_search);
			//echo"\n\$count_find_articles_with_input_search = ".$count_find_articles_with_input_search."\n";
		$data_list['count_find_articles_with_input_search'] = $count_find_articles_with_input_search;
		
		/* Подгружаем view content_page_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		$messageServer['content_page'] = $this->load->view('themes/starter_template/ul_search_view', $data_list, TRUE);
		
		/* Доступ успешен */
		$success = 'yes';
		
		$messageServer['success'] = $success;
			//echo "\n \$messageServer = ";
			//	print_r($messageServer);
		
		echo json_encode($messageServer);
	}	/* ./Посредством AJAX формировать содержимое списка 'Search' */
	


	/**
	 * Through AJAX to create the contents of the "Search" page
	 * (Через AJAX создать содержимое страницы «Поиск»)
	 *
	 * @return	JSON		(echo)
	 * @return	void
	 */
	public function ajax_button_search()
	{
			//echo 'public function ajax_named_page()'."\n";
		
		/* Доступ НЕ удачен */
		$success = 'no';
		
		/* trimed $_POST[] */
		$input_search = $this->input->post('input_search');
			//echo "\n".'$input_search = '.$input_search."\n";
		
		/* Читать все статьи из table 'articles' (массив) */
		$articles_all = $this->divided_access_model->read_articles_all();
			//echo "\n\$articles_all = ";
			//print_r($articles_all);
		
		/* toDo Проверить, что страница по $_POST разрешена к доступу */
		
		/* (array) Названия доступных страниц */
		$session_pages_access = $this->session->pages_group_access;
			//echo "\n \$session_pages_access = ";
			//	print_r($session_pages_access);
		
		/* Отбор доступных старниц */
		foreach($session_pages_access as $key_session_pages_access => $value_session_pages_access)
		{
			if($key_session_pages_access != 0)				/* Да. НЕ первый (нулевой) элемент */
			{
				/* (array) Доступные страницы */
				$pages_access[] = $value_session_pages_access['0'];
			}
		}
			//echo "\n\$pages_access = ";
			//	print_r($pages_access);

		/* Отбор статей из доступных страниц */
		/* Проход по всем доступным страницам */
		foreach($articles_all as $value_articles_all)
		{
			/* Проход по всем доступным страницам */
			foreach($pages_access as $value_pages_access)
			{
				if($value_articles_all['page'] == $value_pages_access)
				{
					/* (array) Все доступные статьи */
					$all_articales_access[] = $value_articles_all;
				}
			}
		}
			//echo "\n\$all_articales_access = \n";
			//	print_r($all_articales_access);
			//echo "\n".'count($all_articales_access) = '.count($all_articales_access)."\n";
			
		/* Инициализация. (array) Найденные доступные статьи, имеющие набираемую строку поиска */
		$find_articles_with_button_search = array();
		/* Проход по всем доступным стаьям */
		foreach($all_articales_access as $value_all_articales_access)
		{
				//echo $value_all_articales_access['article']."\n";
			
			/* Находим вхождение(я) из набираемой строки поиска в текущей статье */
				///* mb_stripos() — Регистронезависимый поиск позиции первого вхождения одной строки в другую (Многобайтные строки) */
				//$pos = mb_stripos($value_all_articales_access['article'], $input_search);
			/* mb_strpos() — Поиск позиции первого вхождения одной строки в другую (Многобайтные строки) */
			$pos = mb_strpos($value_all_articales_access['article'], $input_search);
				//echo"\n\$pos = ".$pos."\n";
			
			if ($pos !== false)  /* Да. (Нет НЕ верно). Найдено первое вхождение строки */
			{
					//echo "Строка $input_value найдена в строке ".$value_all_articales_access['article'];
					//echo " в позиции $pos";
				
				///* (array) Строка без символа конца строки ($str_wihtout_eol['0']) */
				///* explode() — Разбивает строку с помощью разделителя */
				//$str_wihtout_eol = explode(PHP_EOL, $value_all_articales_access['article']);
				//	//echo "\n\$str_wihtout_eol['0'] = ".$str_wihtout_eol['0'];
				//
				///* mb_substr() — Возвращает часть строки (Многобайтные строки) */
				///* (array) Найденные доступные статьи, имеющие набираемую строку поиска */
				///* str_replace() — Заменяет все вхождения строки поиска на строку замены (LF заменяет на 'пробел') */
				////$find_articles_with_button_search[] = str_replace(PHP_EOL, ' ', mb_substr($value_all_articales_access['article'], $pos, '12'));
				//$find_articles_with_button_search[] = mb_substr($str_wihtout_eol['0'], $pos, '2000');
				
				/* (array) Найденные доступные статьи, имеющие набираемую строку поиска */
				$find_articles_with_button_search[] = $value_all_articales_access['article'];
			}
		}
			//echo "\n\$find_articles_with_button_search = ";
			//	print_r($find_articles_with_button_search);
			//echo "\n".'count($find_articles_with_button_search) = '.count($find_articles_with_button_search)."\n";
	
		///* Массив с содержанием названной страницы */
		//$get_content_named_page	= $this->divided_access_model->read_content_named_page($name_page);

		//$data_page['content_page'] = $get_content_named_page;
		$data_page['content_page'] = $find_articles_with_button_search;
		
		/* Подгружаем view content_page_view.php ('TRUE' - локадльно грузим НЕ через http(s):// ) */
		$messageServer['content_page'] = $this->load->view('themes/starter_template/content_search_view', $data_page, TRUE);
		
		/* Доступ успешен */
		$success = 'yes';
		
		$messageServer['success'] = $success;
			//echo "\n \$messageServer = ";
			//	print_r($messageServer);
		
		echo json_encode($messageServer);
	}	/* ./Через AJAX создать содержимое страницы «Поиск» */


}
