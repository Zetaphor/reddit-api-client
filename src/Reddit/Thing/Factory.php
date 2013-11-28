<?php
namespace Reddit\Thing;

use Reddit\Thing;

class Factory
{
	public function createThing(array $input)
	{
		$thing = new Thing\Account;
		return $thing;
	}
}
