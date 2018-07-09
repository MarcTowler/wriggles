<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 29/06/2018
 * Time: 21:10
 */

class Login extends CI_Controller
{
	//Handles all the API stuff
	private $_guzzle;

	public function __construct()
	{
		parent::__construct();

		$this->_guzzle = new GuzzleHttp\Client(['verify'=>false]);
		$this->load->config('twitch');
		$this->load->model('login_model');
	}

	/**
	 * This is where the user will land, we will then check to see if a cookie is present, if not, send to auth
	 */
	public function index()
	{
		/*
		 * first we check to see if the cookie is present, if it is, we then check to see if it is valid
		 * if the answer to either is no then we load the login view, otherwise redirect to store
		 */

		if(is_null(get_cookie('dhu'))) {

			$details = [
				'client'   => $this->config->item('TWITCH_CLIENT_ID'),
				'redirect' => $this->config->item('TWITCH_REDIRECT'),
			];

			$this->load->view('login', $details);
		} else {
			//Cookie is valid, lets move the user along!
			header('Location: ' . base_url() . 'shop');
		}
	}

	/**
	 * lets authenticate the user via twitch login!!!
	 */
	public function auth()
	{
		//did the call come back valid from twitch
		if(isset($_GET['code']) && $_GET['code'] != '')
		{
			$authcode = $_GET['code'];

			//Lets setup all the paramts to go to Twitch ID auth
			$parameters = [
				'client_id'     => $this->config->item('TWITCH_CLIENT_ID'),
				'client_secret' => $this->config->item('TWITCH_SECRET'),
				'redirect_uri'  => $this->config->item('TWITCH_REDIRECT'),
				'code'          => $authcode,
				'grant_type'    => 'authorization_code'
			];

			//Lets make the call to find out if it is valid
			$data = $this->_guzzle->request('POST', 'https://id.twitch.tv/oauth2/token', ['form_params' => $parameters]);

			//cleanse the data
			$data = json_decode($data->getBody(), true);

			//For the OAuth server on twitch
			$params2 = [
				'client-id'     => $this->config->item('TWITCH_CLIENT_ID'),
				'Authorization' => 'OAuth ' . $data['access_token'],
				'accept'        => 'application/vnd.twitchtv.v5+json'
			];

			//lets find out who you are!!!
			$extra = $this->_guzzle->request('GET', 'https://api.twitch.tv/kraken', ['headers' => $params2]);

			//clean it up
			$extra = json_decode($extra->getBody(), true);

			$data['username'] = $extra['token']['user_name'];
			$data['userid']   = $extra['token']['user_id'];

			if($data['username'] != 'wrigglemania') {
				$followed = $this->_guzzle->request('GET', 'https://api.itslit.uk/twitch/followage/' . $data['username'] . '/wrigglemania');
				$data['follower'] = ($followed->getStatusCode() == 200) ? 1 : 0;
			} else {
				$data['follower'] = 1;
			}
			//find out if the user is a sub
			//$subbed = $this->_guzzle->request('GET', 'https://api.twitch.tv/kraken/users/' . $data['userid'] . '/subscriptions/74872188?client_id=' . $params2['client-id']);
			//$data['subscriber'] = ($subbed->getStatusCode() != 404) ? 1 : 0;
			$data['subscriber'] = 1;

			$data['points'] = ($data['follower'] == 1) ? ($data['subscriber'] == 1) ? $this->config->item('sub_points') + $this->config->item('follow_points') : $this->config->item('follow_points') : 0;

			//store it in the db
			$this->login_model->authenticate($data);

			$cookie = array(
				'name'   => 'dhu',
				'value'  => $data['username'],
				'expire' => 86500, // have a high cookie time till you make sure you actually set the cookie
				'domain' => '.localhost', // the first . to make sure subdomains isn't a problem
				'path' => '/'
			);

			set_cookie($cookie);

			header('Location: ' . base_url() . 'shop');
		}
	}
}