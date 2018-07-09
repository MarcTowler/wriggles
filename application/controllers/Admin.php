<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 03/07/2018
 * Time: 22:34
 */

class Admin extends CI_Controller
{
	private $_guzzle;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin_model');
		$this->load->config('twitch');
		$this->_guzzle = new GuzzleHttp\Client(['verify'=>false]);
	}

	public function index()
	{
		//lets check to see if the user is authenticated
		if(!$this->_authorised())
		{
			header('Location: ' . base_url() . 'login');
		}

		$stats = $this->admin_model->getStats();

		$status = $this->_guzzle->request('GET', 'https://api.twitch.tv/kraken/streams/wrigglemania?client_id=' . $this->config->item('TWITCH_CLIENT_ID'));
		$status = json_decode($status->getBody(), true);

		$stats['status'] = (is_null($status['stream'])) ? 'Offline' : 'Live';

		$data['content'] = 'admin/main';
		$data['stats'] = $stats;
		$this->load->view('admin', $data);
	}

	public function addCard()
	{
		if(count($this->input->post()) == 0) {
			$output['decks'] = $this->admin_model->getDecks();
			$output['content'] = 'admin/addcard';
			$this->load->view('admin', $output);
		} else {
			$config['upload_path']          = '../assets/img/products/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			$details = $this->input->post();

			$this->admin_model->addCard($details);

			$data = array('upload_data' => $this->upload->data());

			header('Location:' . base_url() . 'admin/listCards');
		}
	}

	public function addDeck()
	{
		if(count($this->input->post()) == 0) {
			$output['game'] = $this->admin_model->getGames();
			$output['content'] = 'admin/adddeck';
			$this->load->view('admin', $output);
		} else {
			$details = $this->input->post();

			$this->admin_model->addCard($details);

			header('Location:' . base_url() . 'admin/listDecks');
		}
	}

	public function listDecks()
	{
		$decks = $this->admin_model->getDeckDeets();

		$data['content'] = 'admin/listdecks';
		$data['decks']   = $decks;
		$this->load->view('admin', $data);
	}

	public function editdeck()
	{
		if(count($this->input->post()) == 0) {
			//get the card's ID
			$deck = $this->uri->segment('3');

			$sql = $this->admin_model->getDeck($deck);

			$output['game'] = $this->admin_model->getDeckDeets();
			$details['id'] = $sql->id;
			$details['name'] = $sql->name;


			$output['details'] = $details;

			$output['content'] = 'admin/editdeck';
			$this->load->view('admin', $output);
		} else {
			$details = $this->input->post();

			$this->admin_model->editDeck($details);

			header('Location:' . base_url() . 'admin/listdecks');
		}
	}

	public function listCards()
	{
		$cards = $this->admin_model->listCards();

		$data['content'] = 'admin/listcards';
		$data['cards']   = $cards;
		$this->load->view('admin', $data);
	}

	public function editcard()
	{
		if(count($this->input->post()) == 0) {
			//get the card's ID
			$card = $this->uri->segment('3');

			$sql = $this->admin_model->getCard($card);

			$output['decks'] = $this->admin_model->getDecks();
			$details['id'] = $sql->id;
			$details['name'] = $sql->name;
			$details['image_url'] = $sql->image_url;

			$output['details'] = $details;

			$output['content'] = 'admin/editcard';
			$this->load->view('admin', $output);
		} else {
			$config['upload_path']          = '../assets/img/products/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			$details = $this->input->post();

			$this->admin_model->addCard($details);

			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);

			header('Location:' . base_url() . 'admin/listCards');
		}
	}

	public function manageShop()
	{
		$products = $this->admin_model->listproducts();

		$data['content'] = 'admin/listproducts';
		$data['products']   = $products;
		$this->load->view('admin', $data);
	}

	public function addProduct()
	{
		if(count($this->input->post()) == 0) {
			$output['games'] = $this->admin_model->getGames();
			$output['decks'] = $this->admin_model->getDecks();
			$output['content'] = 'admin/addproduct';
			$this->load->view('admin', $output);
		} else {
			$details = $this->input->post();

			$this->admin_model->addProduct($details);

			header('Location:' . base_url() . 'admin/manageShop');
		}
	}

	public function streamState()
	{

	}

	private function _authorised()
	{
		return (is_null(get_cookie('dhu'))) ? false : true;
	}
}