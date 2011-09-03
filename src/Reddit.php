<?php

namespace RedditApiClient;

/**
 * Reddit 
 *
 * The main class of the API client, handling its state and the sending of
 * queries to the API 
 * 
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.00
 */
class Reddit {

	/**
	 * If logged in, stores the value of the reddit_session cookie
	 * 
	 * @access private
	 * @var    string
	 */
	private $sessionCookie;

	/**
	 * Creates the API client instance
	 *
	 * If given a username and password, will attempt to login.
	 * 
	 * @access public
	 * @param  string $username [optional]  The username to login with
	 * @param  string $password [optional]  The password to login with
	 */
	public function __construct($username, $password)
	{
		if ($username && $password && !$this->login($username, $password)) {
			$message = 'Unable to login to Reddit';
			$code    = RedditException::UNABLE_TO_LOGIN;
			throw new RedditException($message, $code);
		}
	}

	/**
	 * Tries to login to Reddit
	 * 
	 * @access public
	 * @return boolean
	 */
	public function login($username, $password)
	{
		$request = new HttpRequest;
		$request->setUrl('http://www.reddit.com/api/login');
		$request->setHttpMethod('POST');
		$request->setPostVariable('user', $username);
		$request->setPostVariable('passwd', $password);

		$response = $request->getResponse();

		$setCookie = $response->getHeader('Set-Cookie');

		if (!preg_match('/reddit_session=([^;]+);', $setCookie, $matches)) {
			return false;
		}

		$cookie = $matches[1];

		$this->sessionCookie = $cookie;

		return true;
	}

}

