<?php
namespace RedditApiClient\Test\Session\Storage;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use RedditApiClient\Session;

class MemoryTest extends PHPUnit_Framework_TestCase
{
	private $memory;
	private $session;

	public function setUp()
	{
		parent::setUp();
		$this->memory = new Session\Storage\Memory;
		$this->session = new Session('exampleuser', 'swordfish', 'poiu');
	}

	/**
	 * @test
	 */
	public function storeSession()
	{
		$this->memory->storeSession($this->session);
		$this->assertEquals(1, count($this->memory));
	}

	/**
	 * @test
	 */
	public function retrieveSession()
	{
		$this->memory->storeSession($this->session);
		$this->assertEquals($this->session, $this->memory->retrieveSession('exampleuser'));
	}
}
