<?php
namespace Reddit\Test\Thing;

use PHPUnit_Framework_TestCase;
use Reddit\Thing;

class FactoryTest extends PHPUnit_Framework_TestCase
{
	private $factory;

	public function setUp()
	{
		$this->factory = new Thing\Factory;
	}

	/**
	 * @test
	 */
	public function createAccount()
	{
		$input = array(
			'kind' => 't2',
			'data' => array(
				'created'     => '1377035773.0',
				'created_utc' => '1377035773.0',
				'has_mail'    => true,
				'is_friend'   => true,
				'name'        => 'jedberg',
			),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Account);
	}
}
