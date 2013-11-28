<?php
namespace Reddit;

use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;
use Reddit\Client;
use Reddit\Session;

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
		$this->injectSessionSubscriber($client, $config);
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

	private function injectSessionSubscriber($client, $config)
	{
		if (isset($config['session.storage']) && $config['session.storage'] instanceof Session\Storage) {
			$sessionStorage = $config['session.storage'];
		} else {
			$sessionStorage = new Session\Storage\Memory;
		}
		$username = isset($config['user']) ? $config['user'] : null;
		$sessionSubscriber = new Session\Subscriber($sessionStorage, $username);
		$client->addSubscriber($sessionSubscriber);
	}
}
