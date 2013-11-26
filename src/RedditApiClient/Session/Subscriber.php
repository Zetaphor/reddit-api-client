<?php
namespace RedditApiClient\Session;

use Guzzle\Common\Event;
use RedditApiClient\Session;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Subscriber implements EventSubscriberInterface
{
	private $storage;
	private $usernam;

	public function __construct(Session\Storage $storage, $username = null)
	{
		$this->storage = $storage;
		$this->username = $username;
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
		if (isset($this->username)) {
			$session = $this->storage->retrieveSession($this->username);
			if ($session instanceof Session) {
				$params = $request->getParams();
				$params->set('uh', $session->getModhash());
			}
		}
	}

	public function onRequestAfterSend(Event $event)
	{
		$request = $event['request'];
		if (preg_match('#^/api/login#', $request->getPath())) {
			$query = $request->getQuery();
			$username = $query['user'];
			$this->updateSession($username, $event['response']);
		}
	}

	private function updateSession($username, $response)
	{
		$body = json_decode($response->getBody());
		if ($this->isSuccessfulLogin($body)) {
			$session = new Session(
				$username,
				$body->json->data->modhash
			);
			$this->storage->storeSession($session);
		}
	}

	private function isSuccessfulLogin($body)
	{
		return isset($body->json->data->modhash);
	}
}

