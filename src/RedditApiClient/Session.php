<?php
namespace RedditApiClient;

class Session
{
	private $username;
	private $modhash;
	private $cookie;

	public function __construct($username, $modhash, $cookie)
	{
		$this->username = $username;
		$this->modhash = $modhash;
		$this->cookie = $cookie;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getModhash()
	{
		return $this->modhash;
	}

	public function getCookie()
	{
		return $this->cookie;
	}
}
