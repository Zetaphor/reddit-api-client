<?php
namespace RedditApiClient;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class ClientFactory
{
	public function createClient(array $config = array())
	{
		$required = array(
			'base_url',
		);

		$defaults = array(
			'base_url' => 'http://www.reddit.com/api',
		);

		$config = Collection::fromConfig($config, $defaults, $required);
		$client = new Client(null, $config);
		$this->injectDescription($client);
		return $client;
	}

	private function injectDescription($client)
	{
		$client->setDescription($this->createDescription());
	}

	private function createDescription()
	{
		$descriptionPath = realpath(__DIR__ . '/../../api/index.json');
		$description = ServiceDescription::factory($descriptionPath);
		return $description;
	}
}
