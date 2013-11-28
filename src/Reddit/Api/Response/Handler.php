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
		if (self::isListing($response)) {
			$things = array();
			foreach ($response['data']['children'] as $input) {
				$things[] = self::thingFactory()->createThing($input);
			}
			return $things;
		} else {
			$thing = self::thingFactory()->createThing($response);
			return $thing;
		}
	}

	private static function isListing($response)
	{
		return isset($response['kind']) && $response['kind'] === 'Listing';
	}

	private static function thingFactory()
	{
		if (!isset(self::$thingFactory)) {
			self::$thingFactory = new Thing\Factory;
		}
		return self::$thingFactory;
	}
}
