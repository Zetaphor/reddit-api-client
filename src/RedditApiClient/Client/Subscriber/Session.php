<?php
namespace RedditApiClient\Client\Subscriber;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Session implements EventSubscriberInterface
{
	private $modhash;

	public function setModHash($modHash)
	{
		$this->modHash = $modHash;
	}

	public function getModHash()
	{
		return $this->modHash;
	}

    public static function getSubscribedEvents()
	{
		return array(
			'request.before_send' => array('onRequestBeforeSend', 255),
			'request.sent' => array('onRequestAfterSend', 255),
		);
	}

	public function onRequestBeforeSend(Event $event)
	{
		$request = $event['request'];

		if (isset($this->modHash)) {
			$params = $request->getParams();
			$params->set('uh', $this->modHash);
		}
	}

	public function onRequestAfterSend(Event $event)
	{
		$request = $event['request'];
		if (preg_match('#^/api/login#', $request->getPath())) {
			$this->updateSession($event['response']);
		}
	}

	private function updateSession($response)
	{
		$body = json_decode($response->getBody());
		if ($this->isSuccessfulLogin($body)) {
			$this->modHash = $body->json->data->modhash;
		}
	}

	private function isSuccessfulLogin($body)
	{
		return isset($body->json->data->modhash);
	}
}
