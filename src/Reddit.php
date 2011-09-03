<?php

namespace RedditApiClient;

class Reddit {

	public function __construct($username, $password)
	{
		if ($username && $password && !$this->login()) {
			$message = 'Unable to login to Reddit';
			$code    = RedditException::UNABLE_TO_LOGIN;
			throw new RedditException($message, $code);
		}
	}

	public function login()
	{
		return false;
	}

}

