<?php
/*
 * This file is the model of default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Divided_access_model extends CI_Model {

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
	 * Read the content of named page
	 * (Содержание названной страницы)
	 * 
	 * @return	array
	 */
	public function read_access_all()
	{
			//echo 'public function read_access_all()';

		//$sql = "SELECT id_access, log_access, passw_access, group_access FROM access WHERE 1 LIMIT 0, 30";
		$sql = "SELECT * FROM access WHERE 1 LIMIT 0, 30 ";

		$query = $this->db->query($sql);

		return $query->result_array();
	}


	/**
	 * Read the content of named page
	 * (Содержание названной страницы)
	 *
	 * @param		The named page
	 * 
	 * @return	array
	 */
	public function read_content_named_page($name_page)
	{
		//$sql = "SELECT id_access, log_access, passw_access, group_access FROM access WHERE 1 LIMIT 0, 30";
		$sql = "SELECT * FROM articles WHERE page='".$name_page."'";

		$query = $this->db->query($sql);
	
		return $query->result_array();
	}


	/**
	 * Read all articles
	 * (Читать все статьи)
	 * 
	 * @return	array
	 */
	public function read_articles_all()
	{
		$sql = "SELECT * FROM articles WHERE 1 LIMIT 0, 30 ";

		$query = $this->db->query($sql);
		
		return $query->result_array();
	}


}
