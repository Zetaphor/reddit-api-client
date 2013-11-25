<?php
namespace RedditApiClient\Test;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
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
	public function createsClient()
	{
		$client = $this->factory->createClient();
		$this->assertTrue($client instanceof Client);
	}

	/**
	 * @test
	 */
	public function injectsServiceDescription()
	{
		$client = $this->factory->createClient();
		$description = $client->getDescription();
		$this->assertTrue($description instanceof ServiceDescription);
	}

	/**
	 * @test
	 */
	public function loadsServiceDescription()
	{
		$client = $this->factory->createClient();
		$description = $client->getDescription();
		$this->assertEquals("Reddit API Client", $description->getName());
	}

	/**
	 * @test
	 */
	public function injectsConfig()
	{
		$client = $this->factory->createClient();
		$config = $client->getConfig();
		$this->assertEquals('http://www.reddit.com/api', $config->get('base_url'));
	}
}
