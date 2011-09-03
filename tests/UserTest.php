<?php

require_once '../src/User.php';
require_once 'PHPUnit/Framework/TestCase.php';

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\User;

/**
 * UserTest 
 * 
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.00
 */
class UserTest extends PHPUnit_Framework_TestCase {

	private $user;

	public function setUp()
	{
		$this->user = new User;
	}

	public function testKnowsIfMod()
	{
		$this->assertFalse($this->user->isMod());
		$this->user->setData(array('is_mod' => true));
		$this->assertTrue($this->user->isMod());
	}

	public function testKnowsIfGold()
	{
		$this->assertFalse($this->user->isGold());
		$this->user->setData(array('is_gold' => true));
		$this->assertTrue($this->user->isGold());
	}

	public function testKnowsIfHasMail()
	{
		$this->assertFalse($this->user->hasMail());
		$this->user->setData(array('has_mail' => true));
		$this->assertTrue($this->user->hasMail());
	}

	public function testKnowsIfHasModMail()
	{
		$this->assertFalse($this->user->hasModMail());
		$this->user->setData(array('has_mod_mail' => true));
		$this->assertTrue($this->user->hasModMail());
	}

}

