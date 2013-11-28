<?php
namespace Reddit\Api\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Reddit\Thing;

class Handler implements ResponseClassInterface
{
	public static function fromCommand(OperationCommand $command)
    {
		$response = $command->getResponse()->json();
		$thing = new Thing\Account;
		return $thing;
	}
}
