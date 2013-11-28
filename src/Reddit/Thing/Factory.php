<?php
namespace Reddit\Thing;

use Reddit\Thing;

class Factory
{
	private $kindClassMap = array(
		't1' => 'Reddit\Thing\Comment',
		't2' => 'Reddit\Thing\Account',
		't3' => 'Reddit\Thing\Link',
		't4' => 'Reddit\Thing\Message',
		't5' => 'Reddit\Thing\Subreddit',
		't6' => 'Reddit\Thing\Award',
		't7' => 'Reddit\Thing\PromoCampaign',
		'Listing' => 'Reddit\Thing\Link',
	);

	public function createThing(array $input)
	{
		if (isset($this->kindClassMap[$input['kind']])) {
			$thing = new $this->kindClassMap[$input['kind']];
		}
		return $thing;
	}
}
