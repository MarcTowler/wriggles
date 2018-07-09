<?php
/**
 * Created by PhpStorm.
 * User: MarcT
 * Date: 29/06/2018
 * Time: 21:48
 */

class login_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function authenticate(array $userItems)
	{
		/*
		 * First we need to check to see if the user is already in db
		 * If it is then we need to update the required details
		 * If not then insert the user
		 */
		$exists = $this->db->query("SELECT COUNT(uid) AS user FROM users WHERE username = ?", [$userItems['username']]);
		$exists = $exists->row();

		//is it there or not????
		if($exists->user > 0)
		{
			$update = $this->db->query("UPDATE users SET `access_token` = ?, `refresh_token` = ?, `follower` = ?, `subscriber` = ? WHERE `username` = ?",
										[$userItems['access_token'], $userItems['refresh_token'], $userItems['follower'], $userItems['subscriber'], $userItems['username']]);
		} else {
			//new user time, YAY
			$insert = $this->db->query("INSERT INTO users (username, userid, access_token, refresh_token, points, follower, subscriber) VALUES(?, ?, ?, ?, ?, ?, ?)",
										[$userItems['username'], $userItems['userid'], $userItems['access_token'], $userItems['refresh_token'], $userItems['points'], $userItems['follower'], $userItems['subscriber']]);

		}
	}
}