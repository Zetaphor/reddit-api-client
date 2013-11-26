<?php
namespace RedditApiClient\Session;

use RedditApiClient\Session;

interface Storage
{
	public function storeSession(Session $session);
	public function retrieveSession($username);
}
