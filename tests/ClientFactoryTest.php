<?php
namespace RedditApiClient\Test;

use PHPUnit_Framework_TestCase;
use RedditApiClient\ClientFactory;

class ClientFactoryTest extends PHPUnit_Framework_TestCase
{
	private $factory;

	public function setUp()
	{
		parent::setUp();
		$this->factory = new ClientFactory;
	}

	/**
	 * @test
	 */
	public function createClient()
	{
	}
}
