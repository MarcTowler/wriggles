<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 29/06/2018
 * Time: 22:37
 */

class shop_model extends CI_Model
{
	private $active_id = NULL;

	public function __construct()
	{
		$this->load->database();
	}

	public function retrieve_products()
	{
		$query = $this->db->query("SELECT * FROM products WHERE game = ?", [$this->get_active_id()]);

		return $query->result_array();
	}

	public function get_active_id()
	{
		$out = '';

		if($this->active_id == NULL)
		{
			$tmp = $this->db->query("SELECT id FROM game WHERE active = 1");

			$out = $tmp->row();

			$this->active_id = empty($out) ? NULL : $out->id;
		}

		return $this->active_id;
	}

	public function get_caps($username)
	{
		//return the latest caps amount, this will be called on page load and re-called when an option is purchased
		$query = $this->db->query("SELECT username, points FROM users WHERE username = ?", [$username]);
		$query = $query->row();

		if(!isset($query->username))
		{
			$output['username'] = 'guest';
			$output['points']   = '0';
		} else {
			$output['username'] = $query->username;
			$output['points'] = $query->points;
		}

		return $output;
	}
}