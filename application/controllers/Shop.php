<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 29/06/2018
 * Time: 22:09
 */

class Shop extends CI_Controller
{
	public $game;
	private $_guzzle;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('shop_model');

		$this->_guzzle = new GuzzleHttp\Client(['verify'=>false]);

		$this->game = $this->_guzzle->request('GET', 'https://api.itslit.uk/twitch/current_game/wrigglemania/false');

	}

	public function index()
	{
		//lets check to see if the user is authenticated
		if(is_null(get_cookie('dhu')))
		{
			header('Location: ' . base_url() . 'login');
		}

			//Is the game a valid game in the db?
		$valid = is_null($this->shop_model->get_active_id()) ? FALSE : TRUE;

		if($valid)
		{
			//we know its in the db so lets pull the cards out
			$data['products'] = $this->shop_model->retrieve_products(); //populate array with the products
			$data['points']   = $this->shop_model->get_caps($_COOKIE['dhu']); //this will normally be from the session

			if(empty($data['products']))
			{
				$this->load->view('closed', $data);
			} else {
				$data['content'] = 'shop/products';
				$this->load->view('store', $data);
			}
		} else {
			$this->load->view('closed');
		}
	}
}