<?php
namespace RedditApiClient\Test;

use Guzzle\Service\Client;
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
		$client = $this->factory->createClient();
		$this->assertTrue($client instanceof Client);
	}
}
