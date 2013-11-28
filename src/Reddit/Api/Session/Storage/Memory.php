<?php
namespace Reddit\Api\Session\Storage;

use Countable;
use Reddit\Api\Session;

class Memory implements Session\Storage, Countable
{
	private $sessions = array();

	public function __construct(array $sessions = array())
	{
		$this->sessions = $sessions;
	}

	public function count()
	{
		return count($this->sessions);
	}

	public function storeSession(Session $session)
	{
		$this->sessions[$session->getUsername()] = $session;
	}

	public function retrieveSession($username)
	{
		if (isset($this->sessions[$username])) {
			return $this->sessions[$username];
		}
	}
}
