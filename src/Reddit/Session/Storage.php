<?php
namespace Reddit\Session;

use Reddit\Session;

interface Storage
{
	public function storeSession(Session $session);
	public function retrieveSession($username);
}
