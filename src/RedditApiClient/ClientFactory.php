<?php
namespace RedditApiClient;

use Guzzle\Service\Client;

class ClientFactory
{
	public function createClient()
	{
		$client = new Client;
		return $client;
	}
}
