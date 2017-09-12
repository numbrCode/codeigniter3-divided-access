<?php
/*
 * This file is the model of default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Codeigniter313_guestbook_model extends CI_Model {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		// Your own constructor code
		$this->load->database('default');
	}


	/**
	 * Get all visible comments
	 * (Получить все видимые комментари)
	 *
	 * @return array
	 */
	public function get_comments()
	{

		$sql = $this->db->select('message_id, author, email, message, created')
							->from('comments')
							->where('show', '1')
							->get_compiled_select();  /* string: SELECT `message_id`, `author`, `email`, `message`, `created` FROM `comments` WHERE `show` = '1' */

		$query = $this->db->query($sql);

		return $query;
	}


	/**
	 * Delete a single comment
	 * (Удалить единичный комментарий)
	 *
	 * @return array
	 */
	public function delete_comment($message_id = NULL)
	{
//		if($message_id == NULL)
//		{
//      $result_delete_comment = array (
//				'delete_comment' => FALSE,
//				'error_delete_comment' => "Номер комментария не определён"				/* for Development */
//			);
//			
//			return $result_delete_comment;
//		}
		
		$message_id = NULL;
		try {
			if($message_id == NULL)
			{
				throw new Exception('Проблема с DB. Номер комментария не определён');
			}
		} catch (Exception $e) {
				echo "\nCaught exception: \$e->getMessage() = ".$e->getMessage()."\n";
				$error = $this->db->error(); /* Has keys 'code' and 'message' */
					
					echo "\n".'delete_comment: $error[] = '."\n";
					var_dump($error);
				
				echo 'function delete_comment(): Error - '.$e;
		}
		
		
		///* DELETE FROM `codeigniter313_guestbook`.`comments` WHERE `comments`.`message_id` = 18 */
		//if ( ! $this->db->delete('comments', array('message_id' => $message_id)))
		//{
		//	$result_delete_comment = array (
		//		'delete_comment' => FALSE,
		//		'error_delete_comment' => $this->db->error()			/* Has keys 'code' and 'message' (for Development) */
		//	);
		//	
		//	return $result_delete_comment;
		//}
		
		
		try {
	    echo"\n".'$message_id = '.$message_id;
			
			/* DELETE FROM `codeigniter313_guestbook`.`comments` WHERE `comments`.`message_id` = 18 */
			//if ( ! $this->db->delete('comments', array('message_id' => $message_id)))
			if ( ! $this->db->delete('comments', array('message_id' => $message_id)))
			{
				throw new Exception('Проблема с DB. Комментарий НЕ удалён.');
			}
		} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				$error = $this->db->error(); /* Has keys 'code' and 'message' */
				echo 'function delete_comment(): Error - '.$e;
		}

		$result_delete_comment = array (
			'delete_comment' => TRUE,
			'error_delete_comment' => 'No'											/* for Development */
		);
		
		return $result_delete_comment;
	}


	/**
	 * Set a new comment
	 * (Добавить новый комментарий)
	 *
	 * @param	array trim $_POST[]
	 *
	 * @return void
	 */
	public function set_new_comment($pst)
	{
		/* Number of last comment (not id with AUTO_INCREMENT) */
		$sql_last_message_id = "SELECT message_id FROM comments WHERE id=(SELECT MAX(id) AS max_id FROM comments)";
		$query = $this->db->query($sql_last_message_id);
		$row = $query->row();

		$last_message_id = $row->message_id;
		
		/* Инкремент последнего номера message_id, полученного из DB, для message_id нового комментария */
		$last_message_id++;
		
		/* The $query result object will no longer be available */
		$query->free_result();

		$new_comment = array(
			'message_id' => $last_message_id,
      'author' => $pst['name'],
			'email' => $pst['email'],
			'message' => $pst['comment'],
			'created' => date('Y-m-d H:i:s'),
			'show' => "1"
    );
		
		if ( ! $this->db->insert('comments', $new_comment))
		{
			//$error = $this->db->error(); /* Has keys 'code' and 'message' */
		}
	}

}
