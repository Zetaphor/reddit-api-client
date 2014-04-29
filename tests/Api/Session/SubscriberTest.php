<?php
namespace Reddit\Test\Api\Session;

use Guzzle\Common\Event;
use Mockery as m;
use PHPUnit_Framework_TestCase;
use Reddit\Api\Session;

class SubscriberTest extends PHPUnit_Framework_TestCase
{
    private $storage;
    private $session;
    private $event;
    private $request;
    private $params;

    public function setUp()
    {
        parent::setUp();
        $this->storage = m::mock('Reddit\Api\Session\Storage');
        $this->subscriber = new Session\Subscriber($this->storage, 'example');
        $this->session = new Session('example', 'swordfish', 'poiu');
        $this->event = new Event;
        $this->request = m::mock('Guzzle\Http\Message\Request');
        $this->response = m::mock('Guzzle\Http\Message\Response');
        $this->params = m::mock('Guzzle\Common\Collection');
        $this->event['request'] = $this->request;
        $this->event['response'] = $this->response;
    }

    /**
     * @test
     */
    public function onRequestBeforeSend()
    {
        $this->storage
            ->shouldReceive('retrieveSession')
            ->with('example')
            ->andReturn($this->session)
            ->once();

        $this->request
            ->shouldReceive('addCookie')
            ->with('reddit_session', 'poiu')
            ->once();

        $this->request
            ->shouldReceive('setHeader')
            ->with('X-Modhash', 'swordfish')
            ->once();

        $this->subscriber->onRequestBeforeSend($this->event);
    }

    /**
     * @test
     */
    public function onRequestAfterSend()
    {
        $this->request
            ->shouldReceive('getPath')
            ->andReturn('/api/login/asdfg')
            ->once();

        $this->request
            ->shouldReceive('getQuery')
            ->andReturn(array('user' => 'example'))
            ->once();

        $this->response
            ->shouldReceive('getBody')
            ->andReturn(
                '{
                    "json":  {
                        "errors":  [],
                        "data":  {
                            "modhash": "e17aznbup819e98e407734a18ef5a38e4b808dcd3c307ae919",
                            "cookie": "23636817,2013-11-25T16:21:14,2ab7f75beab690d42276b3d747d587c7a2bc0e27"
                        }
                    }
                }'
            )
            ->once();

        $this->storage
            ->shouldReceive('storeSession')
            ->once();

        $this->subscriber->onRequestAfterSend($this->event);
    }
}
