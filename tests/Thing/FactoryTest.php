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
	public function createComment()
	{
		$input = array(
			'kind' => 't1',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Comment);
	}

	/**
	 * @test
	 */
	public function createAccount()
	{
		$input = array(
			'kind' => 't2',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Account);
	}

	/**
	 * @test
	 */
	public function createLink()
	{
		$input = array(
			'kind' => 't3',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Link);
	}

	/**
	 * @test
	 */
	public function createMessage()
	{
		$input = array(
			'kind' => 't4',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Message);
	}

	/**
	 * @test
	 */
	public function createSubreddit()
	{
		$input = array(
			'kind' => 't5',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Subreddit);
	}

	/**
	 * @test
	 */
	public function createAward()
	{
		$input = array(
			'kind' => 't6',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\Award);
	}

	/**
	 * @test
	 */
	public function createPromoCampaign()
	{
		$input = array(
			'kind' => 't7',
			'data' => array(),
		);
		$thing = $this->factory->createThing($input);
		$this->assertTrue($thing instanceof Thing\PromoCampaign);
	}

	/**
	 * @test
	 */
	public function hydrateThing()
	{
		$input = array(
			'kind' => 't3',
			'data' => array(
				'title' => 'Moscow Subway is...fascinating',
			),
		);
		$thing = $this->factory->createThing($input);
		$this->assertEquals('Moscow Subway is...fascinating', $thing->title);
	}
}
