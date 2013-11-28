<?php
namespace Reddit\Api\Response;

use Reddit\Thing;

class ThingFactory
{
	private $kindClassMap = array(
		't1' => 'Reddit\Thing\Comment',
		't2' => 'Reddit\Thing\Account',
		't3' => 'Reddit\Thing\Link',
		't4' => 'Reddit\Thing\Message',
		't5' => 'Reddit\Thing\Subreddit',
		't6' => 'Reddit\Thing\Award',
		't7' => 'Reddit\Thing\PromoCampaign',
	);

	public function createThing(array $input)
	{
		if (isset($this->kindClassMap[$input['kind']])) {
			$thing = new $this->kindClassMap[$input['kind']];
			$this->hydrateThing($thing, $input['data']);
		}
		return $thing;
	}

	private function hydrateThing($thing, $properties)
	{
		foreach ($properties as $name => $value) {
			$thing->{$name} = $value;
		}
	}
}
