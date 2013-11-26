<?php
namespace RedditApiClient\Test\Client\Subscriber;

use Guzzle\Common\Event;
use Mockery as m;
use PHPUnit_Framework_TestCase;
use RedditApiClient\Client\Subscriber\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{
	private $session;
	private $event;
	private $request;

	public function setUp()
	{
		parent::setUp();
		$this->session = new Session;
		$this->event = new Event;
		$this->request = m::mock('Guzzle\Http\Message\Request');
		$this->response = m::mock('Guzzle\Http\Message\Response');
		$this->event['request'] = $this->request;
		$this->event['response'] = $this->response;
	}

	/**
	 * @test
	 */
	public function onRequestBeforeSend()
	{
		$this->session->onRequestBeforeSend($this->event);
	}

	/**
	 * @test
	 */
	public function onRequestAfterSend()
	{
		$this->session->onRequestAfterSend($this->event);
	}
}
