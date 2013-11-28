<?php
namespace Reddit\Tests\Api\Response;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Reddit\Api;
use Reddit\Thing;

class HandlerTest extends PHPUnit_Framework_TestCase
{
	private $command;
	private $response;
	private $json;

	public function setUp()
	{
		$this->json = array();
		$this->command = m::mock('Guzzle\Service\Command\OperationCommand');
		$this->response = m::mock('Guzzle\Http\Message\Response');
		$this->command->shouldReceive('getResponse')->andReturn($this->response);
		$this->response->shouldReceive('json')->andReturn($this->json);
	}

	/**
	 * @test
	 */
	public function instantiateAccount()
	{
		$account = Api\Response\Handler::fromCommand($this->command);
		$this->assertTrue($account instanceof Thing\Account);
	}

}
