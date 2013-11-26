<?php
namespace RedditApiClient\Session;

interface Storage
{
	public function storeSession(Session $session);
	public function retrieveSession($username);
}
