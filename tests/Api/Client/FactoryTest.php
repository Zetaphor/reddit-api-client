<?php
namespace Reddit\Test\Api\Client;

use Guzzle\Service\Description\ServiceDescription;
use PHPUnit_Framework_TestCase;
use Reddit\Api;

class FactoryTest extends PHPUnit_Framework_TestCase
{
	private $factory;

	public function setUp()
	{
		parent::setUp();
		$this->factory = new Api\Client\Factory;
	}

	/**
	 * @test
	 */
	public function createsClient()
	{
		$client = $this->factory->createClient();
		$this->assertTrue($client instanceof Api\Client);
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
		$this->assertEquals('http://www.reddit.com/', $config->get('base_url'));
	}
}
