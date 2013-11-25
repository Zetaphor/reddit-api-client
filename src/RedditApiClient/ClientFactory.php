<?php
namespace RedditApiClient;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class ClientFactory
{
	public function createClient(array $config = array())
	{
		$config = $this->createConfig($config);
		$client = new Client($config->get('base_url'), $config);
		$this->injectDescription($client);
		return $client;
	}

	private function createConfig($config)
	{
		$required = array(
			'base_url',
		);

		$defaults = array(
			'base_url' => 'http://www.reddit.com',
		);

		$config = Collection::fromConfig($config, $defaults, $required);
		return $config;
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
