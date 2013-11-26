<?php
namespace RedditApiClient\Client\Subscriber;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Session implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
	{
		return array(
			'request.before_send' => array('onRequestBeforeSend', 255),
			'request.sent' => array('onRequestAfterSend', 255),
		);
	}

	public function onRequestBeforeSend(Event $event)
	{
	}

	public function onRequestAfterSend(Event $event)
	{
		$request = $event['request'];
		if (preg_match('#^/api/login#', $request->getPath())) {
			$this->updateSession($event['response'], $request->getClient());
		}
	}

	private function updateSession($response, $client)
	{
		$body = json_decode($response->getBody());
		if ($this->isSuccessfulLogin($body)) {
			$client->setModHash($body->json->data->modhash);
		}
	}

	private function isSuccessfulLogin($body)
	{
		return isset($body->json->data->modhash);
	}
}
