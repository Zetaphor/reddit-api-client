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
	}
}
