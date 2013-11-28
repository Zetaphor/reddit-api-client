<?php
namespace Reddit\Api\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Reddit\Thing;

class Handler implements ResponseClassInterface
{
	private static $thingFactory;

	public static function setThingFactory($thingFactory)
	{
		self::$thingFactory = $thingFactory;
	}

	public static function fromCommand(OperationCommand $command)
    {
		$response = $command->getResponse()->json();
		$thing = self::thingFactory()->createThing($response);
		return $thing;
	}

	private static function thingFactory()
	{
		if (!isset(self::$thingFactory)) {
			self::$thingFactory = new Thing\Factory;
		}
		return self::$thingFactory;
	}
}
