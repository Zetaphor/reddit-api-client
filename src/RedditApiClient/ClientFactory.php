<?php
namespace RedditApiClient;

use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;
use RedditApiClient\Client;

class ClientFactory
{
	private $defaultConfigOptions = array(
		'base_url' => 'http://www.reddit.com/',
	);

	private $requiredConfigOptions = array(
		'base_url',
	);

	public function createClient(array $config = array())
	{
		$config = $this->createConfig($config);
		$client = new Client($config->get('base_url'), $config);
		$this->injectDescription($client);
		return $client;
	}

	private function createConfig($config)
	{
		$config = Collection::fromConfig(
			$config,
			$this->defaultConfigOptions,
			$this->requiredConfigOptions
		);
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
