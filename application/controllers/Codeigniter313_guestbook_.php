<?php
/*
 * This file is the default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Codeigniter313_guestbook extends CI_Controller {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		
			/* вывод ВСЕХ ошибок на экран (http://phpfaq.ru/sessions) */
			ini_set('display_errors',1);
			error_reporting(E_ALL);
		
		/* Loading the own library (An example of using the own library) */
		$this->load->library('own_library');
		
		/* Loading the helper 'COOKIE' (An example of using the COOKIEs) */
		$this->load->helper('cookie');
		
		/* Loading the session library (An example) */
		$this->load->library('session');
		
		$this->load->model('codeigniter313_guestbook_model');
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
		/* Adding data to session (An example of using the session) */
		$this->session->set_userdata('session.cookie_lifetime',ini_get("session.cookie_lifetime"));
		$this->session->set_userdata('application','Codeigniter313_guestbook');
		$this->session->set_userdata('write','yes');
		
		/* (An example of using the own library) */
		$title = $this->own_library->get_title();
		$data['title'] = $title;
		
		$this->load->view('themes/starter_template/codeigniter313_guestbook_view', $data);
	}


	/**
	 * Get all visible comments from the MySQL via AJAX
	 * (Получить все видимые комментарии из MySQL через AJAX)
	 *
	 * @return	void
	 */
	public function all_comments_ajax()
	{
		$data['heading'] = "Комментарии подгружаются, удаляются и добавляются через AJAX<br>с использованием технологии jQuery.";

		$query = $this->codeigniter313_guestbook_model->get_comments();
		$comment_array = $query->result_array();
		
		$data['comment_array'] = array($comment_array);

		$view_ajax = $this->load->view('themes/starter_template/all_comments_ajax_view', $data, TRUE);
		echo $view_ajax;
	}


	/**
	 * Delete single comment via AJAX
	 * (Удалить единичный комментарий через AJAX)
	 *
	 * @return	void
	 */
	public function delete_ajax()
	{
		$message_id = $this->input->post('message_id');
			
		/* Признак успеха операции Delete */
		$signDeleteMessage = 'buttn_DeleteMessageNo';				/* НЕТ. Провал. */
		
		$result_delete_comment = $this->codeigniter313_guestbook_model->delete_comment($message_id);

		if ($result_delete_comment['delete_comment'])
		{
			$signDeleteMessage = 'buttn_DeleteMessageYes'; 		/* Да. Успешно удалилась запись. */
		}
		
		/* Сообщение о результате от сервера браузеру через AJAX */
		$message_server = $signDeleteMessage;
	
		/* Возвращаем в браузер сообщение от сервера по AJAX */
		echo $message_server;
	}


	/**
	 * Add new comment via AJAX
	 * (Добавить новый комментарий через AJAX)
	 *
	 * @return	void
	 */
	public function add_comment_ajax()
	{
		/* Признак успеха операции Add Comment */
		$signAddComment = 'buttn_AddCommentNo'; /* НЕТ. Comment НЕ добавился */

		/* trimed $_POST[] */
		$pst = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'comment' => $this->input->post('comment')
		);
		
		$this->codeigniter313_guestbook_model->set_new_comment($pst);

			$signAddComment = 'buttn_AddCommentYes'; /* Да. Comment добавился */
		
		/* Сообщение о результате от сервера браузеру через AJAX */
		$message_server = $signAddComment;
		
		/* Возвращаем в браузер сообщение от сервера по AJAX */
		echo $message_server;
	}

}
