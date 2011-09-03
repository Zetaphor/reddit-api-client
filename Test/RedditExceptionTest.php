<?php

namespace RedditApiClient\Test;

require_once 'PHPUnit/Framework/TestCase.php';
require_once '../src/Reddit.php';
require_once '../src/RedditException.php';
require_once 'Stub/RedditLoginRefuser.php';

use \RedditApiClient\Reddit;
use \RedditApiClient\RedditException;
use \PHPUnit_Framework_TestCase;

/**
 * RedditExceptionTest 
 *
 * Verifies that exceptions are thrown correctly by the API client
 * 
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @uses      \PHPUnit_Framework_TestCase
 * @uses      \RedditApiClient\Reddit
 * @uses      \RedditApiClient\RedditException
 * @version   0.00
 */
class RedditExceptionTest extends PHPUnit_Framework_TestCase {

	/**
	 * Tests to make sure that UNABLE_TO_LOGIN exceptions are thrown as expected
	 */
	public function testBadLoginThrowsException()
	{
		$code = null;

		try {
			new Stub_RedditLoginRefuser('invalid user', 'invalid password');
		} catch (RedditException $e) {
			$code = $e->getCode();
		}

		$this->assertEquals(RedditException::UNABLE_TO_LOGIN, $code);
	}

}

