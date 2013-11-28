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
	private $factory;

	public function setUp()
	{
		$this->response = m::mock('Guzzle\Http\Message\Response');
		$this->command = m::mock('Guzzle\Service\Command\OperationCommand');
		$this->factory = m::mock('Reddit\Thing\Factory');
		Api\Response\Handler::setThingFactory($this->factory);
	}

	/**
	 * @test
	 */
	public function instantiateAccount()
	{
		$thing = new Thing\Account;

		$this->command
			->shouldReceive('getResponse')
			->andReturn($this->response)
			->once();

		$this->response
			->shouldReceive('json')
			->andReturn(array('kind' => 't1'))
			->once();

		$this->factory
			->shouldReceive('createThing')
			->with(array('kind' => 't1'))
			->andReturn($thing)
			->once();

		$output = Api\Response\Handler::fromCommand($this->command);
		$this->assertEquals($thing, $output);
	}

	/**
	 * @test
	 */
	public function processListing()
	{
		$thing = new Thing\Account;
		$listing = array(
			'kind' => 'Listing',
			'data' => array(
				'children' => array(
					array(
						'kind' => 't1',
						'data' => array(),
					),
				),
			),
		);

		$this->command
			->shouldReceive('getResponse')
			->andReturn($this->response)
			->once();

		$this->response
			->shouldReceive('json')
			->andReturn($listing)
			->once();

		$this->factory
			->shouldReceive('createThing')
			->with(array('kind' => 't1', 'data' => array()))
			->andReturn($thing)
			->once();

		$output = Api\Response\Handler::fromCommand($this->command);
		$this->assertEquals(array($thing), $output);
	}

}
