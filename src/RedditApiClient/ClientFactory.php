<?php
namespace RedditApiClient;

use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class ClientFactory
{
	public function createClient()
	{
		$client = new Client;
		$description = new ServiceDescription;
		$client->setDescription($description);
		return $client;
	}
}
