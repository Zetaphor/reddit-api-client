<?php
namespace RedditApiClient;

class Session
{
	private $username;
	private $modhash;

	public function __construct($username, $modhash)
	{
		$this->username = $username;
		$this->modhash = $modhash;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getModhash()
	{
		return $this->modhash;
	}
}
