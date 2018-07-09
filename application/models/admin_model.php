<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 03/07/2018
 * Time: 23:00
 */

class admin_model extends CI_Model
{
	public $activegame;

	public function __construct()
	{
		$this->load->database();
	}

	public function get_game()
	{
		$out = '';

		$tmp = $this->db->query("SELECT name FROM game WHERE active = 1");

		$out = $tmp->row();

		return $out->name;
	}

	public function getStats()
	{
		$array = [
			'caps'     => $this->_get_total_points(),
			'users'    => $this->_get_total_users(),
			'game'     => $this->get_game(),
			'products' => $this->getNumProducts(),
			];

		return $array;
	}

	public function getDeckDeets()
	{
		$tmp = $this->db->query("SELECT d.id, d.name, d.description, g.name AS game FROM decks d INNER JOIN game g ON d.game_id = g.id");
		$out = $tmp->result_array();

		return $out;
	}

	public function getGames()
	{
		$tmp = $this->db->query("SELECT id, name FROM game");
		$out = $tmp->result_array();

		return $out;
	}

	public function getDeck($id)
	{
		$tmp = $this->db->query("SELECT * FROM game WHERE id = ?", [$id]);
		$out = $tmp->row();

		return $out;
	}

	public function listProducts()
	{
		$tmp = $this->db->query("SELECT p.id, p.name, p.price, p.image, p.description, g.name AS game, d.name AS deck FROM products p INNER JOIN decks d ON d.id = p.deck_id INNER JOIN game g ON g.id = p.game");
		$out = $tmp->result_array();

		return $out;
	}

	public function addProduct(array $details)
	{
		$this->db->query("INSERT INTO products (name, price, image, description, game, deck_id) VALUES(?, ?, ?, ?, ?, ?)", [$details['name'], $details['price'], $details['userfile'], $details['description'], $details['game'], $details['deck']]);
	}

	public function listCards()
	{
		$tmp = $this->db->query("SELECT c.id, c.name, c.rarity, c.image_url, d.name AS deck FROM card c INNER JOIN decks d ON c.deck_id = d.id ORDER BY deck_id, id");
		$out = $tmp->result_array();

		return $out;
	}

	public function getCard($id)
	{
		$tmp = $this->db->query("SELECT * FROM card WHERE id = ?", [$id]);
		$out = $tmp->row();

		return $out;
	}

	public function getDecks()
	{
		$tmp = $this->db->query("SELECT id, name FROM decks");
		$out = $tmp->result_array();

		return $out;
	}

	public function addCard(array $details)
	{
		$this->db->query("INSERT INTO card (name, rarity, image_url, deck_id) VALUES(?, ?, ?, ?)", [$details['name'], $details['rarity'], $details['userfile'], $details['deck']]);
	}

	private function getNumProducts()
	{
		$tmp = $this->db->query("SELECT count(p.id) AS products FROM products p INNER JOIN game g ON p.game = g.id WHERE g.active = 1");

		$out = $tmp->row();

		return $out->products;
	}

	private function _get_total_points()
	{
		$out = $this->db->query("SELECT SUM(points) As total FROM users");
		$out = $out->row();

		return $out->total;
	}

	private function _get_total_users()
	{
		$out = $this->db->query("SELECT COUNT(uid) AS users FROM users");
		$out = $out->row();

		return $out->users;
	}
}