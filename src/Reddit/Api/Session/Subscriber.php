<?php
namespace Reddit\Api\Session;

use Guzzle\Common\Event;
use Reddit\Api\Session;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Subscriber implements EventSubscriberInterface
{
    private $storage;
    private $username;

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
                $request->addCookie('reddit_session', $session->getCookie());
                $request->setHeader('X-Modhash', $session->getModhash());
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
            $this->username = $username;
            $session = new Session(
                $username,
                $body->json->data->modhash,
                $body->json->data->cookie
            );
            $this->storage->storeSession($session);
        }
    }

    private function isSuccessfulLogin($body)
    {
        return isset($body->json->data->modhash);
    }
}
