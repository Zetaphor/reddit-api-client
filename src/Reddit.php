<?php

namespace RedditApiClient;

require_once 'HttpRequest.php';
require_once 'HttpResponse.php';
require_once 'RedditException.php';

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
	 * Stores the last seen modhash value
	 *
	 * The modhash is an anti-XSRF measure. It's a value returned with each
	 * set of data, different each time, that must be passed along with the
	 * next request.
	 * 
	 * @access private
	 * @var    string
	 */
	private $modHash;

	/**
	 * Creates the API client instance
	 *
	 * If given a username and password, will attempt to login.
	 * 
	 * @access public
	 * @param  string $username [optional]  The username to login with
	 * @param  string $password [optional]  The password to login with
	 */
	public function __construct($username = null, $password = null)
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

	/**
	 * Sends a request to Reddit and returns the response received
	 * 
	 * @access public
	 * @param  string $verb  'GET', 'POST', ...
	 * @param  string $url   'http://www.reddit.com/comments/6nw57.json'
	 * @param  string $body 
	 * @return array
	 */
	public function getData($verb, $url, $body = '')
	{
		$request = new HttpRequest;
		$request->setUrl($url);
		$request->setHttpMethod($verb);

		if ($verb === 'POST' && is_array($body)) {
			foreach ($body as $name => $value) {
				$request->setPostVariable($name, $value);
			}
		}

		if ($this->sessionCookie !== null) {
			$request->setCookie('reddit_session', $this->sessionCookie);
		}

		$response = $request->getResponse();
		$responseBody = $response->getBody();
		$response = json_decode($responseBody, true);

		if (isset($response['data']['modhash'])) {
			$this->modHash = $response['data']['modhash'];
		}

		return $response;
	}



}

