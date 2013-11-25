<?php
namespace RedditApiClient;

use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class ClientFactory
{
	public function createClient()
	{
		$client = new Client;
		$this->injectDescription($client);
		return $client;
	}

	private function injectDescription($client)
	{
		$client->setDescription($this->createDescription());
	}

	private function createDescription()
	{
		$description = new ServiceDescription;
		return $description;
	}
}
